spl_autoload_register(function ($class_name) {
$class_file = strtolower($class_name) . '.php';
$class_path = __DIR__ . '/classes/' . $class_file;
if (file_exists($class_path)) {
require_once $class_path;
}
});

