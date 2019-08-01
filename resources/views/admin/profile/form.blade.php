<form role="form" method="POST" action="{{ route('admin.profile.update') }}">
    @csrf
    <div class="box-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group {{ ($errors->has('first_name') ? 'has-error' : '') }}">
                    <label for="input-first-name">First Name</label>
                    <input name="first_name" type="text" class="form-control" id="input-first-name" placeholder="Enter First Name" value="{{ old('first_name', $user->first_name) }}">
                    @if ($errors->has('first_name'))
                        <label class="help-block">{{ $errors->first('first_name') }}</label>
                    @endif
                </div>
                <div class="form-group {{ ($errors->has('last_name') ? 'has-error' : '') }}">
                    <label for="input-last-name">Last Name</label>
                    <input name="last_name" type="text" class="form-control" id="inpur-last-name" placeholder="Enter Last Name" value="{{ old('last_name', $user->last_name) }}">
                    @if ($errors->has('last_name'))
                        <label class="help-block">{{ $errors->first('last_name') }}</label>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Email" value="{{ old('email', $user->email) }}" disabled>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>