<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AuthorResource\Pages;
use App\Filament\Resources\AuthorResource\RelationManagers;
use App\Models\Author;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AuthorResource extends Resource
{
    protected static ?string $model = Author::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('position')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('profile_picture')->image()
                        ->disk("public")
                        ->maxSize(5120)
                        ->imageCropAspectRatio('10:10')
                        ->directory("authors")
                        ->columnSpan([
                            'sm' => 2,
                        ]),
                    Forms\Components\RichEditor::make('bio')
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('github_handle')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('twitter_handle')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('instagram_handle')
                        ->maxLength(255)
                        ->default(null),
                ])->columns(["sm" => 2])->columnSpan(2),
                Forms\Components\Section::make()->schema([
                    Forms\Components\Placeholder::make("Created at")
                        ->content(fn (?Author $record) => $record ? $record->created_at->diffForHumans() : "-"),
                    Forms\Components\Placeholder::make("Updated at")
                        ->content(fn (?Author $record) => $record ? $record->updated_at->diffForHumans() : "-")
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateIcon('heroicon-o-user-minus')
            ->emptyStateDescription('Once authors are added, they will appear here.')
            ->columns([
                Tables\Columns\ImageColumn::make('profile_picture')
                    ->label("Image")
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\IconColumn::make('github_handle')
                    ->label("Github")
                    ->boolean(),
                Tables\Columns\IconColumn::make('twitter_handle')
                    ->label("Twitter")
                    ->boolean(),
                Tables\Columns\IconColumn::make('instagram_handle')
                    ->label("Instagram")
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListAuthors::route('/'),
            'create' => Pages\CreateAuthor::route('/create'),
            'edit' => Pages\EditAuthor::route('/{record}/edit'),
        ];
    }
}
