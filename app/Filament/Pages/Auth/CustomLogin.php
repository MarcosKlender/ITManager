<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login;
use Illuminate\Contracts\Support\Htmlable;

class CustomLogin extends Login
{
    public function getHeading(): string | Htmlable
    {
        return __('IT Manager');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
            ]);
    }
}
