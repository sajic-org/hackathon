<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRoles;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                DateTimePicker::make('email_verified_at'),
                TextInput::make('workos_id')
                    ->required(),
                Textarea::make('avatar')
                    ->required()
                    ->columnSpanFull(),
                Select::make('role')
                    ->options(UserRoles::class)
                    ->default('user')
                    ->required(),
                Select::make('team_id')
                    ->relationship('team', 'name'),
            ]);
    }
}
