<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'STUDENT SECTION';

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
                            $query->students();
                        }),

                    TextInput::make('student_number')
                        ->label('Student ID'),
                    
                    Radio::make('year_level')
                        ->options([
                            '1' => '1st Year',
                            '2' => '2nd Year',
                            '3' => '3rd Year',
                            '4' => '4th Year'
                        ])
                        ->required(),

                    TextInput::make('section')
                        ->label('Section')
                        ->required(),

                    Radio::make('gender')
                        ->label('Gender')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                            'other' => 'Other',
                        ])
                        ->required(),

                    DatePicker::make('date_of_birth')
                        ->format('d/m/Y')
                        ->required(),

                    TextInput::make('address')
                        ->label('Address'),
                        
                    TextInput::make('phone_number')
                        ->label('Phone Number')
                        ->numeric(),
                    
                    Select::make('program_id') 
                        -> label('Program')
                        ->required() 
                        ->relationship('program', 'program_name') 
                        ->native(false)
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.full_name')
                    ->label('Student Name')
                    -> searchable(),
                
                TextColumn::make('student_number')
                    ->label('Student ID')
                    -> searchable(),

                TextColumn::make('year_level')
                    ->label('Year Level'),

                TextColumn::make('program.program_name')
                    ->label('Program Enrolled'),

                TextColumn::make('section')
                    ->label('Section'),

                TextColumn::make('date_of_birth')
                    ->label('Birth Date')
                    ->date(),

                TextColumn::make('gender')
                    ->label('Gender'),
                
                TextColumn::make('phone_number')
                    ->label('Phone Number'),
                
                TextColumn::make('address')
                    ->label('Address'),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
