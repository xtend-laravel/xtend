<?php

namespace CodeLabX\XtendLaravel\Services\Translation;

class FileLoader extends \Illuminate\Translation\FileLoader
{
    /**
     * Load a local namespaced translation group for overrides.
     *
     * @param  array  $lines
     * @param  string  $locale
     * @param  string  $group
     * @param  string  $namespace
     * @return array
     */
    protected function loadNamespaceOverrides(array $lines, $locale, $group, $namespace)
    {
        $file = "{$this->path}/{$locale}/{$group}.php";
        if (! $this->files->exists($file)) {
            $file = app()->langPath()."/vendor/{$namespace}/{$locale}/{$group}.php";
        }

        if ($this->files->exists($file)) {
            return array_replace_recursive($lines, $this->files->getRequire($file));
        }

        return $lines;
    }
}
