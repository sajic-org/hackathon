<?php

namespace App\Filament\Resources\Teams\Tables;

use App\Models\Team;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Time')->extraImgAttributes(['class' => 'rounded-sm aspect-[5/3] min-h-20'])->width('13%'),

                TextColumn::make('name')->label(' ')->description(fn (Team $record) => $record->project ?? '-')
                    ->searchable()->extraAttributes(['class' => 'pl-1 ml-1']),

                TextColumn::make('members.name')->label('Membros')
                    ->listWithLineBreaks()
                    ->expandableLimitedList()->limitList(2)
                    ->formatStateUsing(fn ($state) => collect(explode(', ', $state))
                        ->map(fn ($name) => Str::of($name)->words(2, ''))
                        ->implode(', ')
                    ),

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
                EditAction::make()->hiddenLabel(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
