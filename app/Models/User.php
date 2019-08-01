<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Yajra\DataTables\DataTables;
use App\Models\PropertyFavorite;
use App\Traits\Imagable;
use App\Traits\Fileable;


class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    use MainModel;
    use Imagable, Fileable {
        Imagable::upload insteadOf Fileable;
        Fileable::upload as uploadDocument;
    }

    protected $dataTables;
    protected $propertyFavorite;
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'first_name',
        'last_name',
        'email',
        'calling_code',
        'phone_number',
        'gender',
        'dob',
        'email_verified_at',
        'phone_verified_at',
        'nationality_id',
        'company_id',
        'password',
        'is_active',
        'is_email_notified',
        'is_sms_notified',
        'is_whatsapp_notified',
        'is_newsletter_enabled',
        'is_verified_identity',
        'is_verified_selfie',
        'is_confirmed_identity',
    ];
    protected $hidden = ['password', 'remember_token'];
    protected $appends = ['property_favorites', 'avatar', 'full_name'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dataTables = new DataTables;
        $this->propertyFavorite = new PropertyFavorite;
    }

    public function verifications()
    {
        return $this->hasMany('App\Models\VerificationCode');
    }

    public function informations()
    {
        return $this->hasOne('App\Models\UserInformation');
    }

    public function documents()
    {
        return $this->hasOne('App\Models\LegalDocument');
    }

    public function createNew($data, $companyId = null)
    {
        $calling_code = (!empty($data['calling_code']) ? $data['calling_code'] : '+62');
        $userData = [
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'email'          => $data['email'],
            'phone_number'   => $data['phone_number'],
            'password'       => bcrypt($data['password']),
            'dob'            => date('Y-m-d', strtotime($data['dob'])),
            'nationality_id' => $data['nationality_id'],
            'gender'         => $data['gender'],
            'calling_code'   => $calling_code,
        ];
        if (isset($companyId)){
            $userData['company_id'] = $companyId;
        }
        return Self::create($userData);
    }

    public function getFullNameAttribute()
    {
        if ($this->first_name) {
            $name = $this->first_name;

            if ($this->last_name) {
                $name .= ' ' . $this->last_name;
            }

            return $name;
        }

        if ($this->last_name) {
            return $this->last_name;
        }

        return $this->email;
    }

    public function getPhoneNumberFullAttribute()
    {
        return preg_replace('/\D/', '', $this->calling_code.$this->phone_number);
    }

    public function getDobAttribute($value)
    {
        return date('d/m/Y', strtotime($value));
    }

    public function changePhoneNumber($data)
    {
        $userData = [
            'calling_code'   => $data['calling_code'],
            'phone_number'   => $data['phone_number'],
        ];
        return Self::update(
            ['id' => $data['user_id']],
            $userData
        );
    }

    public function ajaxDatatables($role)
    {
        $users = $this->query();
        $users->whereHas('roles', function($q) use ($role) {
            $q->whereName($role);
        })->get();

        return $this->dataTables->of($users)
            ->addColumn('action', function ($users) {
                $btn = $users->is_active ? 'btn-danger' : 'btn-success';
                $icon = $users->is_active ? 'fa-times-circle' : 'fa-check-circle';
                $title = $users->is_active ? 'Deactive account' : 'Activate account';

                return '<a class="btn btn-xs '. $btn .' updateStatus" data-url="'.route('manage-user.update-status', ['id' => $users->id]).'"
                    data-status="'.$users->is_active.'" data-toggle="tooltip" title="'.$title.'"><i class="fa '.$icon.'"></i></a>';
            })
            ->editColumn('is_active', '{{ $is_active ? "Active" : "Inactive" }}')
            ->addIndexColumn()
            ->make(true);
    }

    public function getPropertyFavoritesAttribute()
    {
        $favorites = $this->propertyFavorite->whereUserId($this->id)->get();
        return $favorites->map(function ($item, $key) {
            return $item->property_id;
        });
    }

    public function getAvatarAttribute()
    {
        $avatar = $this->images()
            ->where('imagable_id', $this->id)
            ->where('thumbnail', 'thumb')
            ->where('type', 'avatar')
            ->first();

        return $avatar ?? false;
    }

    public function files()
    {
        return $this->morphMany('App\Models\File', 'fileable');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imagable');
    }

    public function medium_images()
    {
        return $this->images()->where('thumbnail', 'medium');
    }

    public function thumb_images()
    {
        return $this->images()->where('thumbnail', 'thumb');
    }

    public function updateProfile($data)
    {
        $date = str_replace('/', '-', $data['dob']);
        $dob = date('Y-m-d', strtotime($date));
        return tap($this->find(auth()->user()->id))->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'gender' => $data['gender'],
                'nationality_id' => $data['nationality_id'],
                'dob' => $dob,
                'is_email_notified' => $data['is_email_notified'],
                'is_sms_notified' => $data['is_sms_notified'],
                'is_whatsapp_notified' => $data['is_whatsapp_notified'],
                'is_newsletter_enabled' => $data['is_newsletter_enabled']
            ])->fresh();
    }

    public function savePhoto($photo, $type)
    {
        $user = auth()->user();
        $photoType = config('constants.profile.image_'.$type);

        $extension = explode(";", explode("/", $photo)[1])[0];
        $filename = $type.'-'.$user->id.'.'.$extension;
        $photo = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $photo));

        file_put_contents($filename, $photo);
        $user->upload(public_path($filename), ['medium', 'thumb'], $photoType);
        unlink(public_path($filename));

        $newPhoto = $user->images()
            ->where('imagable_id', $user->id)
            ->where('type', $photoType)
            ->get();

        return response()->json(['status' => true, 'data' => $newPhoto]);
    }

    public function updateProfileEmail($data)
    {
        return tap($this->find(auth()->user()->id))->update([
                'email' => $data['email'],
                'email_verified_at' => null,
            ])->fresh();
    }

    public function updateProfilePhone($data)
    {
        return tap($this->find(auth()->user()->id))->update([
                'calling_code' => $data['calling_code'],
                'phone_number' => $data['phone_number'],
                'phone_verified_at' => null,
            ])->fresh();
    }

    public function updateProfilePassword($data)
    {
        if ($data['new_password'] != $data['confirm_password']) {
            return response()->json([
                'status' => false,
                'data'   => ''
            ]);
        }

        $user = tap($this->find(auth()->user()->id))->update([
                'password' => bcrypt($data['new_password'])
            ])->fresh();

        return response()->json([
            'status' => true,
            'data'   => $user
        ]);
    }

    public function saveDocument($file, $type)
    {
        $docType = config('constants.profile.document_'.$type);

        $user = auth()->user();
        $data = $user->uploadDocument($file, $docType);

        return response()->json(['status' => true, 'data' => $data]);
    }
}

