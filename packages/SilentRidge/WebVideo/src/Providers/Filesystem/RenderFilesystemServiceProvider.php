<?php

declare(strict_types=1);

namespace WebVideo\Providers\Filesystem;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemServiceProvider;

/**
 * @internal
 */
final class RenderFilesystemServiceProvider extends FilesystemServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        parent::register();


        $this->app->alias('render.filesystem.tmp', Filesystem::class);
        $this->app->alias('render.filesystem.software', Filesystem::class);
        $this->app->alias('render.filesystem.result', Filesystem::class);

    }
}
