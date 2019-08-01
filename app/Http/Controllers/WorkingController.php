<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCommunityRequest;
use Illuminate\Http\Request;
use App\Models\Community;


class WorkingController extends Controller
{
    public function __construct(Community $community) {
        $this->community = $community;     
    }

    function showing_agent() {
        $data = [
            'caption_btn' => 'Enroll Now',
            'caption_action' => '#',
            'process' => [
                [
                    'num'=>'01',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Select your sector',
                    'description'=>'You’re probably more comfortable showing or surveying properties near your home or workplace.',
                ],
                [
                    'num'=>'02',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Input your availabilities',
                    'description'=>'We value your flexibility.
                    Tell us when you’re comfortable making money.',
                ],
                [
                    'num'=>'03',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Use our proptech platform',
                    'description'=>'A state of the art digital tool in the palm of your hands! So you can focus on making money.',
                ],
                [
                    'num'=>'04',
                    'image'=>url('img/renter_illustrasi4.png'),
                    'title'=>'Start earning more income',
                    'description'=>'Earn up to 100,000 IDR per visit!
                    Achieve milestones to unlock premiums on leasing deals.
                     Our instant payment system means you can withdraw your earnings whenever and wherever you want.',
                ]
            ],
            'reccommend' => [
                [
                    'quote' => 'Sewagi allows me to handle my property from anywhere. No more spending time in traffic just to sign lease contract.',
                    'user' => [
                        'image' => url('img/renter_illustrasi1.png'),
                        'name' => 'George Norton',
                        'role' => 'Homeowner'
                    ]
                ],
                [
                    'quote' => 'Sewagi allows me to handle my property from anywhere. No more spending time in traffic just to sign lease contract.',
                    'user' => [
                        'image' => url('img/renter_illustrasi1.png'),
                        'name' => 'George Norton',
                        'role' => 'Homeowner'
                    ]
                ]
            ],
            'faq' => [
                [
                    'title' => 'How do Sewagi payments work?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
                [
                    'title' => 'How should I price my listing on Sewagi?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
                [
                    'title' => 'Does Sewagi provide any insurance for property owner?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
            ]
        ];
        return view('working.showing_agent', $data);
    }

    function company_staff() {
        $data = [
            'caption_btn' => 'Register Now',
            'caption_action' => '#',
            'benefit' => [
                [
                    'num'=>'01',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>' Seamless renting',
                    'description'=>'Trouble finding homes for your expats or on-location experts? No problem! We’ll help you  find the right accommodation for your employees and on your terms.',
                ],
                [
                    'num'=>'02',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Secure online payment',
                    'description'=>'Want your employees close to what matters most? No worries, <a href="#">our commute time</a> feature will help you find accomodations near your project areas with short to middle terms flexibility you need.',
                ],
                [
                    'num'=>'03',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Simple management tool',
                    'description'=>'Need nice homes for team building? Say no more! We’re here to help you find the perfect environment your team needs.',
                ]
            ],
            'process' => [
                [
                    'num'=>'01',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>' Create your listing online',
                    'description'=>'Browse properties Select terms Visit properties on preferred time Sign contracts digitally Place your employees Re-book properties easily
                    ',
                ],
                [
                    'num'=>'02',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Sign your contract digitally',
                    'description'=>'No problem! Our payment gateway is built with your flexibility in mind. ',
                ],
                [
                    'num'=>'03',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'No sweat, get your passive income',
                    'description'=>'No problem! Our payment gateway is built with your flexibility in mind. ',
                ],
                [
                    'num'=>'04',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Intelligent customer support and services',
                    'description'=>'One platform for after sales support and employees home needs. Insured living means you don’t need worry for your employees welfare. Our dedicated customer agents will always be on top of your standards. ',
                ]
            ],
            'reccommend' => [
                'quote' => 'Sewagi allows me to handle my property from anywhere. No more spending time in traffic just to sign lease contract.',
                'user' => [
                    'image' => url('img/renter_illustrasi1.png'),
                    'name' => 'George Norton',
                    'role' => 'Homeowner'
                ]
            ],
            'faq' => [
                [
                    'title' => 'How do Sewagi payments work?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
                [
                    'title' => 'How should I price my listing on Sewagi?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
                [
                    'title' => 'Does Sewagi provide any insurance for property owner?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
            ]
        ];
        return view('working.company_staff', $data);
    }

    function company_client() {
        $data = [
            'caption_btn' => 'Register Now',
            'caption_action' => '#',
            'benefit' => [
                [
                    'num'=>'01',
                    'image'=>url('img/renter_illustrasi4.png'),
                    'title'=>' On-site employees',
                    'description'=>'Trouble finding homes for your expats or on-location experts? No problem! We’ll help you find the right accommodation for your employees and on your terms.',
                ],
                [
                    'num'=>'02',
                    'image'=>url('img/owner2.svg'),
                    'title'=>'Project & Training oriented employees',
                    'description'=>'Want your employees close to what matters most? No worries, our <a href="#">commute time</a> feature will help you find accomodations near your project areas with short to middle terms flexibility you need.',
                ],
                [
                    'num'=>'03',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Team building & trade fairs',
                    'description'=>'Need nice homes for team building? Say no more! We’re here to help you find the perfect environment your team needs.',
                ]
            ],
            'process' => [
                [
                    'num'=>'01',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>' Seamless renting',
                    'description'=>'Browse properties Select terms Visit properties on preferred time Sign contracts digitally Place your employees Re-book properties easily',
                ],
                [
                    'num'=>'02',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Secure online payment',
                    'description'=>'30 days invoicing? No problem! Our payment gateway is built with your flexibility in mind.',
                ],
                [
                    'num'=>'03',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Simple management tool',
                    'description'=>"Unified user dashboard Tracj invoices and expenses accross several billing addresses easily. Differentiate billing from what your employees comsume and what you've agreed to cover",
                ],
                [
                    'num'=>'04',
                    'image'=>url('img/renter_illustrasi3.png'),
                    'title'=>'Intelligent customer support and services',
                    'description'=>'One platform for after sales support and employees home needs. Insured living means you don’t need worry for your employees welfare. Our dedicated customer agents will always be on top of your standards. ',
                ]
            ],
            'reccommend' => [
                [
                    'quote' => 'Sewagi allows me to handle my property from anywhere. No more spending time in traffic just to sign lease contract.',
                    'user' => [
                        'image' => url('img/renter_illustrasi1.png'),
                        'name' => 'George Norton',
                        'role' => 'Homeowner'
                    ]
                ],
                [
                    'quote' => 'Sewagi allows me to handle my property from anywhere. No more spending time in traffic just to sign lease contract.',
                    'user' => [
                        'image' => url('img/renter_illustrasi1.png'),
                        'name' => 'George Norton',
                        'role' => 'Homeowner'
                    ]
                ]
            ],
            'faq' => [
                [
                    'title' => 'How do Sewagi payments work?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
                [
                    'title' => 'How should I price my listing on Sewagi?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
                [
                    'title' => 'Does Sewagi provide any insurance for property owner?',
                    'description' => 'Lorem ipsum dolor sit amet, consect eturadiyesu piscing elit. Ut maximus blandit orci, utueb aeya placerat orci iaculis in. Donec feugiat.',
                ],
            ]
        ];
        return view('working.company_client', $data);
    }

    public function registerCommunity(RegisterCommunityRequest $request)
    {
        try {
            $community = $this->community->createNew($request);
            return response()->json([
                'status' => true,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);   
        }
    }
}
