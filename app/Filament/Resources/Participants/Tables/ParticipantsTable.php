<?php

namespace App\Filament\Resources\Participants\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;

class ParticipantsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')->label('Nome')->circular()->width('1%')
                    ->default(fn ($record) => 'https://ui-avatars.com/api/?name='.urlencode($record->name ?? 'User'))
                    ->extraImgAttributes([
                        'class' => 'ml-3',
                    ]),

                TextColumn::make('name')->label(' ')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('ticket_code')
                    ->label('Ingresso')
                    ->placeholder('-')
                    ->searchable(),

                TextColumn::make('team.name')->label('Time')
                    ->description(fn (User $record) => $record->team->project)
                    ->searchable()
                    ->placeholder('-'),

                CheckboxColumn::make('showed_up')->label('Check In')->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // ViewAction::make()->hiddenLabel(),
                // EditAction::make()->hiddenLabel()->visible(Gate::allows('is_admin')),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
