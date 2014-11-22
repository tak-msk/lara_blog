<?php
class Helpers {
	const MODULE_PATH = '/app/views/modules';
	public static function getModuleNames()
	{
		$path = base_path() . self::MODULE_PATH;
		$files = File::files($path);
		foreach($files as $file)
		{
            $line = fgets(fopen($file, 'r'));
			$m_name = preg_replace('/[!-\/:-@≠\[-`{-~]|\r|\n/i', '', $line);
			$m_file = preg_replace('{' . $path . '/(((?!\.).)*).*$}', '$1', $file);
			$modules[$m_file] = $m_name;
		}
		return $modules;
	}
}
