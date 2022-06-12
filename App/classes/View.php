<?php
class View
{
    public function render(string $template, array $data): string
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function display(string $template, array $data)
    {
        echo $this->render($template, $data);
    }
}
