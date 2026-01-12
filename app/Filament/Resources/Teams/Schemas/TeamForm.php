<?php

namespace App\Filament\Resources\Teams\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Imagem')
                    ->required(false)
                    ->nullable()
                    ->image()
                    ->imageEditor()
                    ->required(),

                TextInput::make('name')
                    ->label('Nome do Time')
                    ->required(),

                TextInput::make('project')
                    ->label('Nome do Projeto')
                    ->required(),

                Select::make('members')
                    ->label('Membros')
                    ->relationship(
                        name: 'members',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn ($query, $record) => $query->where('role', 'participant')
                            ->where(fn ($q) => $q->whereNull('team_id')
                                ->orWhere('team_id', $record?->id)
                            )
                    )
                    ->getOptionLabelsUsing(fn (array $values): array => User::whereIn('id', $values)
                        ->pluck('name', 'id')
                        ->toArray()
                    )
                    ->multiple()
                    ->searchable()
                    ->preload(),
            ]);
    }
}
