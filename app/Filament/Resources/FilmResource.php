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
use Filament\Forms\Components\TagsInput;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illauminate\Support\Facades\Storage;


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
            => $set('slug', Str::slug(strtolower($state))))
            ->columnSpanFull(),
            Hidden::make('slug'),
            Hidden::make('user_id')
            ->default(Auth::id()),
            Select::make('genre_id')
            ->multiple()
            ->label('Genre')
            ->options(fn() => \App\Models\Genre::pluck('name', 'id'))
            ->required(),
            Forms\Components\MarkdownEditor::make('synopsis')
            ->required()
            ->columnSpanFull(),
            TextInput::make('release_year')
            ->required()
            ->numeric(),
            Forms\Components\FileUpload::make('poster')
            ->required()
            ->image()
            ->deleteUploadedFileUsing(fn ($record) => $record && $record->image ? Storage::disk('public')->delete($record->image) : null)
            ->disk('public')
            ->imageEditor(true)
            ->panelLayout('grid')
            ->imageEditorAspectRatios([
                '4:3'
            ])
            ->columnSpanFull(),
            TextInput::make('trailer_url')
            ->columnSpanFull()
            ]);
            
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('release_year'),
                TextColumn::make('slug')


            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modal(),
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
        ];
    }
}
