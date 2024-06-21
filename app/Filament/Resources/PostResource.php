<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make("Main data")->description("Main data that will be key and also data that will be informed to first-time visitors")->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(debounce: 300)
                        ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                            if (($get('slug') ?? '') !== Str::slug($old)) {
                                return;
                            }
                            $set('slug', Str::slug($state));
                        })
                        ->maxLength(255),
                    Forms\Components\TextInput::make('slug')
                        ->readOnly()
                        ->required(),
                    Forms\Components\Textarea::make('excerpt')
                        ->rows(4)
                        ->columnSpanFull(),
                    Forms\Components\FileUpload::make('banner')
                        ->image()
                        ->imageCropAspectRatio("16:9")
                        ->disk("public")
                        ->maxSize(5120)
                        ->directory("posts")
                        ->default(null)
                        ->columnSpanFull(),
                    Forms\Components\RichEditor::make('content')
                        ->required()
                        ->columnSpanFull(),
                    Forms\Components\Select::make('blog_author_id')
                        ->label('Category')
                        ->relationship(name: 'category', titleAttribute: 'name')
                        ->searchable(),
                    Forms\Components\Select::make('blog_category_id')
                        ->label("Author")
                        ->relationship(name: "author", titleAttribute: "name")
                        ->searchable(),
                ])->columns(["sm" => 2])->columnSpan(2),
                Forms\Components\Section::make("Additional data")->description("Some information or data that you might want to configure")->schema([
                    Forms\Components\DatePicker::make('published_at')->default(now()),
                    Forms\Components\Select::make('status')
                        ->selectablePlaceholder(false)
                        ->default(true)
                        ->options([
                            false => 'Draft',
                            true => 'Published',
                        ]),
                    Forms\Components\Placeholder::make("Created at")
                        ->content(fn (?Post $record): string => $record ? $record->created_at->diffForHumans() : "-"),
                    Forms\Components\Placeholder::make("Upated at")
                        ->content(fn (?Post $record): string => $record ? $record->updated_at->diffForHumans() : "-")
                ])->columnSpan(1)
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateIcon('heroicon-o-bookmark')
            ->emptyStateDescription('Determine the category and author before making a post.')
            ->columns([
                Tables\Columns\ImageColumn::make('banner')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->alignCenter()
                    ->falseIcon("heroicon-o-archive-box")
                    ->falseColor("warning"),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
