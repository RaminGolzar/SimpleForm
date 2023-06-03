<?php
namespace SimpleForm;

class SimpleForm
{

    /**
     * style for input type text|email|password
     *
     * @var type
     */
    private $inputStyle = "w3-input w3-border w3-round w3-margin-top";

    /**
     * background color for all inputs
     *
     * @var string
     */
    public string $inputBgColor = 'white';

    /**
     * style for input type select
     *
     * @var type
     */
    private $dropdownStyle = 'w3-margin-top w3-select w3-round w3-border';

    /**
     * contain complette html form
     *
     * @var type
     */
    private $form = '';

    /**
     * Background color for form tag
     *
     * @var string
     */
    public string $formBgColor = '';

    /**
     * Whether the form has border or not
     *
     * @var bool
     */
    public bool $formBorder = false;

    /**
     * Whether the corner of the form are rounded or not
     *
     * @var bool
     */
    public bool $formRound = false;

    /**
     * Whether the form has padding or not
     *
     * @var bool
     */
    public bool $formPadding = true;

    /**
     * Whether the form has margin or not
     *
     * @var bool
     */
    public bool $formMargin = false;

    /**
     * set heading tag for form tag
     *
     * @param string $titr
     * @param int $level - valid value is [1-6]
     * @param string $fontSize - valid value is (tiny, small, medium, large, xlarge & ... . w3.css dependence framework)
     * @return object
     */
    public function Heading (string $titr , bool $bold = true , int $headingLevel = 2 , string $fontSize = 'large' , string $color = ''): object {
        // set text color
        $color = ($color) ? "w3-text-$color" : null;

        // detect for bolding text
        if ($bold) {
            $this->form .= "<h$headingLevel class='$color w3-section w3-block w3-center w3-$fontSize'><b>$titr</b></h$headingLevel>";
        } else {
            $this->form .= "<h$headingLevel class='$color w3-section w3-block w3-center w3-$fontSize'>$titr</h$headingLevel>";
        }

        return $this;
    }

    /**
     * return row element for inputs form
     *
     * @param string $content
     * @param bool $padding
     * @param bool $margin
     * @param string $color
     * @return string
     */
    private function row (string $content): string {
        return "<section class='w3-margin-top w3-row'>$content</section>";
    }

    /**
     * generate input type text
     *
     * @param string $name - name and id attr
     * @param string $title - for label
     * @param string $value
     * @param string $placeholder
     * @return object
     */
    public function text (string $name , string $title = '' , string $value = '' , string $placeholder = ''): object {
        // set label
        $html = ($title) ? "<label for='$name'>$title</label>" : null;

        // set margin for input text
        $class = ($title) ? 'w3-margin-bottom' : null;

        // set input text
        $html .= "<input type='text' id='$name' name='$name' value='$value' class='$class $this->inputStyle w3-$this->inputBgColor' placeholder='$placeholder' />";

        $this->form .= $this->row ($html);

        return $this;
    }

    /**
     * generate input type email
     *
     * @param string $name - name and id attr
     * @param string $title - for label
     * @param string $value
     * @param string $placeholder
     * @return object
     */
    public function email (string $name , string $title = '' , string $value = '' , string $placeholder = ''): object {
        // set label
        $html = ($title) ? "<label for='$name'>$title</label>" : null;

        // set margin for input text
        $class = ($title) ? 'w3-margin-bottom' : null;

        // set input email
        $html .= "<input type='email' id='$name' name='$name' value='$value' class='$class $this->inputStyle w3-$this->inputBgColor' placeholder='$placeholder' />";

        $this->form .= $this->row ($html);

        return $this;
    }

    /**
     * generate input type password
     *
     * @param string $name - name and id attr
     * @param string $title - for label
     * @param string $value
     * @param string $placeholder
     * @return object
     */
    public function password (string $name , string $title = '' , string $value = '' , string $placeholder = ''): object {
        // set label
        $html = ($title) ? "<label for='$name'>$title</label>" : null;

        // set margin for input text
        $class = ($title) ? 'w3-margin-bottom' : null;

        // set input password
        $html .= "<input type='password' id='$name' name='$name' value='$value' class='$class $this->inputStyle w3-$this->inputBgColor' placeholder='$placeholder' />";

        $this->form .= $this->row ($html);

        return $this;
    }

    /**
     * generate input type submit
     *
     * submit param discription:
     *      1- array key is input name + space + button color that
     *      by default is blue.
     *      2- array value is input value.
     *
     * @param array $submit
     * @param string $align - valid value is right | left
     * @return object
     */
    public function submit (array $submit , array $attr = [] , string $align = ''): object {
        $html = '';

        // ------------------------------------------------------------
        // concat user class to built-in class (set_button_style method)

        $class = (string) '';
        if (key_exists ('class' , $attr)) {
            $class = $attr['class'];
            unset ($attr['class']);
        }

        // ------------------------------------------------------------
        // concat attr array to string for helper method

        $strAttr = (string) '';

        foreach ($attr as $k => $v) {
            $strAttr .= "$k='$v' ";
        }

        // ------------------------------------------------------------
        // create submit & link button and set attr

        foreach ($submit as $k => $v) {
            $key = explode (' ' , $k);

            /* detect by $k for genetate submit or link button.
             * if $k contain url then generate link button else
             * generate submit button.
             */
            if (filter_var (current ($key) , FILTER_VALIDATE_URL)) {
                $html .= $this->link_button (current ($key) , $v , $align , end ($key));
            } else {
                $html .= "<input type='submit' id='" . current ($key) . "' name='" . current ($key) . "' value='$v' class='" . $this->set_button_style ($align , $k) . " " . $class . "' $strAttr'  />";
            }
        }

        // ------------------------------------------------------------
        // output & result

        $this->form .= $this->row ($html);

        return $this;
    }

    /**
     * genetate link button
     *
     * @param string $url
     * @param string $title
     * @param string $align
     * @param string $color
     * @return string
     */
    private function link_button (string $url , string $title , string $align , string $color): string {
        $class = $this->set_button_style ($align , $url . ' ' . $color);

        return "<a href='$url' class='$class'>$title</a>";
    }

    /**
     * set button style, for submit method
     *
     * @param string $align
     * @param string $submitName - because contain name & color, extract color from name
     *
     * @return string
     */
    private function set_button_style (string $align , string $submitName): string {
        $buttonStyle = "w3-margin-top w3-button w3-round w3-mobile";

        /* set margin (bayad ba tavajoh be align tanzim
         * shavad , yani bayad faghat as yek taraf margin dashte
         * bashad ta button ha kheyli as ham faseleh nagirand)
         */
        if ($align == 'left' || empty ($align)) {
            $buttonStyle .= " w3-margin-right";
        } elseif ($align == 'right') {
            $buttonStyle .= " w3-margin-left";
        }

        // set alignment
        if ($align) {
            $buttonStyle .= " w3-$align";
        }

        // set button color
        if (count ($ex = explode (' ' , $submitName)) == 2) {
            $buttonStyle .= " w3-$ex[1] w3-hover-$ex[1]";
        } else {
            $buttonStyle .= " w3-blue w3-hover-blue";
        }

        return $buttonStyle;
    }

    /**
     * generate input type checkbox
     *
     * @param string $name - name and id attr
     * @param string $title - for label
     * @param string $value
     * @param bool $checked
     * @return object
     */
    public function checkbox (string $name , string $title = '' , string $value = '' , bool $checked = false): object {
        $checked = $checked ? ' checked ' : '';

        $html = "<input type='checkbox' "
                . $checked
                . " id='$name' name='$name' value='$value' class='w3-check w3-margin-top' />";
        $html .= "<label for='$name' class='w3-padding-small'>$title</label>";

        $this->form .= $this->row ($html , false , true);

        return $this;
    }

    /**
     * generate input type radio
     *
     * @param string $name - name and id attr
     * @param string $title - for label
     * @param string $value
     * @param bool $checked
     * @return object
     */
    public function radio (string $name , string $title = '' , string $value = '' , bool $checked = false): object {
        $checked = $checked ? (string) " checked " : '';

        $html = "<input type='radio'"
                . $checked
                . " id='$name' name='$name' value='$value' class='w3-radio' />";

        $html .= "<label for='$name' class='w3-padding'>$title</label>";

        $this->form .= $this->row ($html , true , true);

        return $this;
    }

    /**
     * generate input type select (drop down)
     *
     * @param string $name - name & id attr
     * @param string $title
     * @param array $option
     * @param array $selected
     * @return object
     */
    public function dropdown (string $name , string $title = '' , array $option = [] , string $selected = ''): object {
        $html = "<label for='$name'>$title</label>";

        $html .= "<select id='$name' name='$name'>"
                . $this->option_tag ($option , $selected)
                . "</select>";

        $this->form .= $this->row ($html);

        return $this;
    }

    /**
     * Return string of option tag
     *
     * @param array $option
     * @return string
     */
    private function option_tag (array $options , string $selected = ''): string {
        $result = '';

        foreach ($options as $k => $v) {
            if ($selected == $v) {
                $result .= "<option value='$k' selected>$v</option>";
            } else {
                $result .= "<option value='$k'>$v</option>";
            }
        }

        return $result;
    }

    public function textarea (string $name , string $title = '' , string $value = '' , string $placeholder = ''): object {
        // set label
        $html = ($title) ? "<label for='$name'>$title</label>" : null;

        // set margin for input text
        $class = ($title) ? 'w3-margin-bottom' : null;

        // set textarea
        $html .= "<textarea id='$name' name='$name' class='$class $this->inputStyle w3-$this->inputBgColor' style='height: 110px; resize: vertical;' placeholder='$placeholder'>$value</textarea>";

        $this->form .= $this->row ($html , false , true);

        return $this;
    }

    /**
     * return a input hidden
     *
     * @param string $name
     * @param string $value
     * @return string
     */
    public function hidden (string $name , string $value): object {
        $html = "<input type='hidden' id='$name' name='$name' value='$value' />";

        $this->form .= $this->row ($html);

        return $this;
    }

    /**
     * This function return result along with
     * the form tag
     *
     * @param string $action
     * @param string $method
     * @return string
     */
    public function get_form (bool $style = true , string $action = '' , $method = 'post' , ?array $attr = null): string {
        // add style to form tag
        if ($style) {
            $attr['class'] = $this->form_style ();
        }

        /* add method param to attr array */
        $attr ['method'] = $method;

        $htmlForm = "<form action='$action' " . $this->prepare_attr ($attr) . ">";

        $htmlForm .= $this->form;

        $htmlForm .= "</form>";

        // empty form property for next use
        $this->form = '';

        return $htmlForm;
    }

    /**
     * Return a string of attribute(s)
     *
     * @param array $attr
     * @return string
     */
    private function prepare_attr (array $attr): string {
        $result = '';

        foreach ($attr as $k => $v) {
            $result .= "$k='$v' ";
        }

        return $result;
    }

    /**
     * set form style, use in get_form method
     *
     * @return string
     */
    private function form_style (): string {
        $style = (string) '';

        $style .= $this->formBgColor ? "w3-$this->formBgColor " : null;
        $style .= $this->formBorder ? "w3-border " : null;
        $style .= $this->formRound ? "w3-round-large " : null;
        $style .= $this->formPadding ? "w3-padding-large " : null;
        $style .= $this->formMargin ? "w3-section " : null;

        return $style;
    }

    /**
     * This function return result without the
     * form tag
     *
     * @return string
     */
    public function get (): string {
        $inputs = $this->form;

        // empty form property for next use
        $this->form = '';

        return $inputs;
    }

}
