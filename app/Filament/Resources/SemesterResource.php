<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SemesterResource\Pages;
use App\Filament\Resources\SemesterResource\RelationManagers;
use App\Models\Semester;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;

class SemesterResource extends Resource
{
    protected static ?string $model = Semester::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('school_name') ->required(),
                    TextInput::make('school_id') ->required(),
                    DatePicker::make('start_date') ->native(false) ->displayFormat('d/m/Y') ->required(),
                    DatePicker::make('end_date') ->native(false) ->displayFormat('d/m/Y') ->required(),
                    Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'completed' => 'Completed'
                    ])
                    ->visibleOn('edit')
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn:: make('name'),
                TextColumn:: make('school_name'),
                TextColumn:: make('school_id'),
                TextColumn::make('status')
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
            'index' => Pages\ListSemesters::route('/'),
            'create' => Pages\CreateSemester::route('/create'),
            'edit' => Pages\EditSemester::route('/{record}/edit'),
        ];
    }
}
