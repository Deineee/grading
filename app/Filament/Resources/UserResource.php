<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make(2)->schema([ // Setting the grid to 1 column
                TextInput::make('name')->label('User name')->required(),
                TextInput::make('first_name')->label('First name')->required(),
                TextInput::make('middle_name')->label('Middle name')->required(),
                TextInput::make('last_name')->label('Last name')->required(),
                TextInput::make('email')->email()->required(),
                Select::make('role')->required()->options(User::ROLES)->native(false),
                TextInput::make('password')->password()->required()->revealable()->minLength(8)->visibleOn('create'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn:: make('id'),
                TextColumn:: make('name')->label('USER NAME'),
                TextColumn::make('full_name')
                ->label('FULL NAME'),
                TextColumn:: make('email') ->icon('heroicon-m-envelope')->label('EMAIL'),
                TextColumn:: make('role')->label('ROLE')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
