<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacultyResource\Pages;
use App\Filament\Resources\FacultyResource\RelationManagers;
use App\Models\Faculty;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class FacultyResource extends Resource
{
    protected static ?string $model = Faculty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'DEPARTMENT SECTION';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([ 
                    Select::make('user_id')
                    ->label('Name')
                    ->required() 
                    ->native(false)
                    ->relationship('user', 'name', function ($query) {
                        $query->teachers();
                    }),
                ]),
                Select::make('semester_id') -> label('Semester')->required() ->relationship('semester', 'name',) ->native(false),
                Select::make('department_id') -> label('Department')->required() ->relationship('department', 'description') ->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn:: make('name')->label('USER NAME') -> searchable(),
                TextColumn:: make('full_name')->label('FULL NAME') -> searchable(),
                TextColumn:: make('email') ->icon('heroicon-m-envelope')->label('EMAIL')->copyable()->copyMessage('Copied!')->copyMessageDuration(1500),
                TextColumn:: make('status') ->label('STATUS') -> badge(),
                TextColumn:: make('semester_name')->label('SEMESTER') -> searchable(),
                TextColumn:: make('department_name')->label('DEPARTMENT') -> searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFaculties::route('/'),
            'create' => Pages\CreateFaculty::route('/create'),
            'edit' => Pages\EditFaculty::route('/{record}/edit'),
        ];
    }
}
