<?php

namespace App\Filament\Pages\Auth;

use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\View;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BasePage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;

class Login extends BasePage
{


    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getNameFormComponent(): Component
    {
        return TextInput::make('name')
            ->label('Login')
            ->required()
            ->autocomplete()
            ->autofocus()
            ->extraInputAttributes(['tabindex' => 1]);
    }


    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'name' => $data['name'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.name' => "Data Tidak Ditemukan!",
        ]);
    }


    public function getHeading(): string | Htmlable
    {
        $view = View::make('filament.authHeading')->render();
        return new HtmlString($view);
    }
    public function getSubHeading(): string | Htmlable
    {
        $view = View::make('filament.authSubheading')->render();
        return new HtmlString($view);
    }
}
