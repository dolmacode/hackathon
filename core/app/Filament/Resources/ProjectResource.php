<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Category;
use App\Models\Project;
use App\Models\RoleToPermission;
use App\Models\Status;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Проект';

    protected static ?string $pluralModelLabel = 'Проекты';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label("Название проекта")
                        ->required(),
                    Forms\Components\RichEditor::make('description')
                        ->label("Описание проекта"),
                    Forms\Components\Select::make('admin_id')
                        ->label("Владелец/Администратор проекта")
                        ->searchable()
                        ->options(User::all()->pluck('name', 'id')),
                ]),
                Card::make()->columns(2)->schema([
                    Repeater::make("categories")
                        ->relationship()
                        ->label("Категории")
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Название категории')
                                ->required(),
                        ]),
                    Repeater::make("statuses")
                        ->relationship()
                        ->label("Статусы задач")
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Название')
                                ->required(),
                            Forms\Components\TextInput::make('slug')
                                ->label('Идентификатор (латиницей)')
                                ->required(),
                        ]),
                ]),
                Card::make()->columns(2)->schema([
                    Repeater::make("tasks")
                        ->relationship()
                        ->label("Задачи проекта")
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label("Название")
                                ->required(),
                            Forms\Components\RichEditor::make('description')
                                ->label("Описание"),
                            Forms\Components\Select::make('status')
                                ->label('Статус задачи')
                                ->required()
                                ->searchable()
                                ->options(Status::all()->pluck('name', 'id')),
                            Forms\Components\Select::make('priority')
                                ->label('Приоритет')
                                ->options([
                                    'Низкий' => 'Низкий',
                                    'Средний' => 'Средний',
                                    'Высокий' => 'Высокий',
                                ]),
                            Forms\Components\Select::make('project_id')
                                ->label("Проект")
                                ->searchable()
                                ->options(Project::all()->pluck('name', 'id'))
                                ->required(),
                            Forms\Components\Select::make('creator_id')
                                ->label("Создатель задачи")
                                ->searchable()
                                ->options(User::all()->pluck('name', 'id'))
                                ->required(),
                            Forms\Components\Select::make('category_id')
                                ->label("Категория")
                                ->searchable()
                                ->options(Category::all()->pluck('name', 'id'))
                                ->required(),
                            Forms\Components\DatePicker::make('deadline')
                                ->label("Срок сдачи задачи"),
                            Forms\Components\Toggle::make('is_completed')
                                ->label("Галочка 'Задача завершена'")
                        ]),
                        Repeater::make("members")
                            ->relationship()
                            ->label("Участники")
                            ->schema([
                                Forms\Components\Select::make('user_id')
                                    ->label('Пользователь')
                                    ->searchable()
                                    ->options(User::all()->pluck('name', 'id'))
                                    ->required(),
                                Forms\Components\Select::make('role')
                                    ->label('Роль пользователя')
                                    ->searchable()
                                    ->options(RoleToPermission::all()->pluck('role_title', 'role'))
                                    ->required(),
                            ]),
                    ]),
                    Card::make()->columns(2)->schema([
                        Repeater::make('files')
                            ->relationship()
                            ->schema([
                                Forms\Components\FileUpload::make('file')
                                    ->label("Загрузка файла"),
                            ]),
                        Repeater::make('roles')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('role')
                                    ->label("Роль (латиницей)"),
                                Forms\Components\TextInput::make('role_title')
                                    ->label("Название роли (кирилицей)"),
                                Forms\Components\Hidden::make('permission')->default("all"),
                                Forms\Components\Hidden::make('permission_title')->default("Все"),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Название проекта')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
