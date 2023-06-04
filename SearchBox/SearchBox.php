<?php
namespace SimpleForm\SearchBox;

/* Submit.php trait */
require_once __DIR__
        . DIRECTORY_SEPARATOR
        . 'Handelers'
        . DIRECTORY_SEPARATOR
        . 'Submit.php';

/* text.php trait */
require_once __DIR__
        . DIRECTORY_SEPARATOR
        . 'Handelers'
        . DIRECTORY_SEPARATOR
        . 'Text.php';

class SearchBox
{

    use Handelers\Text;
    use Handelers\Submit;

    /**
     * Submit align <p>valid value is: left | right</p>
     *
     * @var string
     */
    public string $align = 'left';

    /**
     * Generate search box
     *
     * @return string
     */
    public function create_searchbox (string $action = '' , string $method = 'post'): string {
        $txt = $this->generate_text ();
        $btn = $this->generate_submit ();

        return "<form action='$action' method='$method' class='w3-container'>$btn $txt</form>";
    }

}
