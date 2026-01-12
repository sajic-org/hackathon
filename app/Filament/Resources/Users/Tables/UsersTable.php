<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')->label('Nome')->circular()->width('1%'
                    ->default(fn ($record) => 'https://ui-avatars.com/api/?name='.urlencode($record->name ?? 'User'))
                )->extraImgAttributes([
                    'class' => 'ml-3',
                ]),

                TextColumn::make('name')->label(' ')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                SelectColumn::make('role')
                    ->label('Papel')
                    ->options([
                        'admin' => 'Admin',
                        'appraiser' => 'Jurado',
                        'commission' => 'Comissão',
                        'participant' => 'Participante',
                    ])
                    // ->default(fn ($record) => $record->role)
                    ->searchable(),

                TextColumn::make('team.name')->label('Time')->grow()
                    ->searchable()->placeholder('-')->description(fn (User $record) => $record->team->project),

                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->hiddenLabel(),
                EditAction::make()->hiddenLabel(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
