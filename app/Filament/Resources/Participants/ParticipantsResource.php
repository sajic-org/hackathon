<?php

namespace App\Filament\Resources\Participants;

use App\Enums\UserRoles;
use App\Filament\Resources\Participants\Pages\CreateParticipants;
use App\Filament\Resources\Participants\Pages\EditParticipants;
use App\Filament\Resources\Participants\Pages\ListParticipants;
use App\Filament\Resources\Participants\Pages\ViewParticipants;
use App\Filament\Resources\Participants\Schemas\ParticipantsForm;
use App\Filament\Resources\Participants\Schemas\ParticipantsInfolist;
use App\Filament\Resources\Participants\Tables\ParticipantsTable;
use App\Models\User;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class ParticipantsResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected static ?string $modelLabel = 'Participante';

    // public static function getEloquentQuery(): Builder
    // {
    //     return User::whereRole(UserRoles::PARTICIPANT);
    // }

    public static function canAccess(): bool
    {
        return Gate::allows('is_admin') || Gate::allows('is_commission');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return Gate::allows('is_admin');
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return ParticipantsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ParticipantsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ParticipantsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListParticipants::route('/'),
            // 'create' => CreateParticipants::route('/create'),
            // 'view' => ViewParticipants::route('/{record}'),
            // 'edit' => EditParticipants::route('/{record}/edit'),
        ];
    }
}
