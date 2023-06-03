<?php
namespace SimpleForm\SearchBox;

class SearchBox
{

    use Handlers\Text;
    use Handlers\Submit;

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
