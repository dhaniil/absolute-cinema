<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FilmResource\Pages;
use App\Filament\Resources\FilmResource\RelationManagers;
use App\Models\Film;
use Filament\Forms;
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Hidden;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FilmResource extends Resource
{
    protected static ?string $model = Film::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                ->required()
                ->afterStateUpdated(fn ($state, callable $set)
                => $set('slug', Str::slug(strtolower($state)))
                ),
                Hidden::make('user_id')
                ->default(Auth::id()),
                Select::make('genre_id')
                ->options(fn() => \App\Models\Genre::pluck('name', 'id'))
                ->required(),
                Hidden::make('slug'),
                Forms\Components\MarkdownEditor::make('synopsis')
                ->required(),
                TextInput::make('release_year')
                ->required()
                ->numeric(),
                Forms\Components\FileUpload::make('poster')
                ->required()
                ->disk('public')
                ->imageEditor(true),
                TextInput::make('trailer_url')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('release_year'),
                TextColumn::make('synopsis')

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
            'index' => Pages\ListFilms::route('/'),
            'create' => Pages\CreateFilm::route('/create'),
            'edit' => Pages\EditFilm::route('/{record}/edit'),
        ];
    }
}
