<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\FileUpload;
use Livewire\Component;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use Filament\Facades\Filament;


class Register extends Component implements HasForms
{
    use InteractsWithForms;

    public User $user;

    public $name = '';
    public $email = '';
    public $password = '';
    public $passwordConfirmation  = '';
    public $mobile_number = '';
    public $avatar = '';

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('Personal Information')
                ->schema([
                    TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(50),
                    TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->maxLength(50)
                    ->unique(User::class),
                    TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->maxLength(50)
                    ->minLength(8)
                    ->same('passwordConfirmation')
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state)),
                    TextInput::make('passwordConfirmation')
                    ->label('Confirm Password')
                    ->password()
                    ->required()
                    ->maxLength(50)
                    ->minLength(8)
                    ->dehydrated(false),
                ])
                ->columns([
                    'sm' => 2,
                ])
                ->columnSpan([
                    'sm' => 2,
                ]),
                Wizard\Step::make('Company Information')
                ->schema([
                    TextInput::make('mobile_number')
                    ->label('Tel')
                    ->tel()
                    ->required()
                    ->maxLength(14)
                    ->unique(User::class),
                    FileUpload::make('avatar')->label('Profile pic')->image()->directory('avatars'),
                ])
            ])
            ->columns([
                'sm' => 1,
                ])
            ->columnSpan([
                'sm' => 1,
            ])
            ->submitAction(new HtmlString('<button type="submit">Register</button>'))

        ];
    }

    public function register()
    {
        $user = User::create($this->form->getState());
        Filament::auth()->login(user: $user, remember:true);
        return redirect()->intended(Filament::getUrl('filament.pages.dashboard'));
    }

    public function render(): View
    {
        return view('livewire.register');
    }
}

// protected $rules = [
//     'name' => 'required|string|max:255',
//     'email' => 'required|string|email|max:255|unique:users',
//     'mobile_number' => 'required|string|unique:users',
//     'password' => 'required|string|min:8|confirmed',
//     'avatar' => 'required|image|max:2048', // Assuming avatar is an image file
// ];
    // public function register()
    // {
    //     $this->validate();

    //     $user = User::create([
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         'mobile_number' => $this->mobile_number,
    //         'password' => Hash::make($this->password),
    //         'avatar' => $this->avatar->store('avatars'), // Assuming 'avatars' is your storage path
    //     ]);

    //     Auth::login($user);

    //     return redirect('/');
    // }

    // public function render()
    // {
    //     return view('livewire.register');
    // }
