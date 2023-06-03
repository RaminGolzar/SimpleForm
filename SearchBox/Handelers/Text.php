<?php
namespace SimpleForm\SearchBox\Handelers;

trait Text
{

    /**
     * Name attribute
     *
     * @var string
     */
    public string $txtName = 'txt_search';

    /**
     * Placeholder attribute
     *
     * @var string
     */
    public string $txtPlaceholder = 'Search ...';

    /**
     * Background & text color style
     *
     * @var string
     */
    public string $txtColor = '';

    /**
     * Set border & border color style
     *
     * @var string
     */
    public string $txtBorderColor = 'gray';

    /**
     * Value attribute
     *
     * @var string
     */
    public string $txtValue = '';

    /**
     * Hold to all attributes
     *
     * @var string
     */
    private string $textAttr = '';

    /**
     * This method called by SearchBox class
     *
     * This method returned a input text
     *
     * @return string
     */
    protected function generate_text (): string {
        $this->setup_text ();

        return $this->create_input_text ();
    }

    /**
     * Set all attributes for input text
     *
     * @return void
     */
    private function setup_text (): void {
        $this->text_name ();

        $this->text_value ();

        $this->text_placeholder ();

        $this->text_style ();
    }

    /**
     * Set name attribute
     *
     * @return void
     */
    private function text_name (): void {
        $this->textAttr .= 'name="' . $this->txtName . '" ';
        $this->textAttr .= 'id="' . $this->txtName . '" ';
    }

    /**
     * Set placeholder attribute
     *
     * @return void
     */
    private function text_placeholder (): void {
        $this->textAttr .= $this->txtPlaceholder ? 'placeholder="' . $this->txtPlaceholder . '" ' : null;
    }

    /**
     * Set value attribute
     *
     * @return void
     */
    private function text_value (): void {
        $this->textAttr .= $this->txtValue ? 'value="' . $this->txtValue . '" ' : null;
    }

    /* ----------------------------------------------------------------------
     * Setup style for input text
     * ----------------------------------------------------------------------
     */

    /**
     * Setup all atyle for input text
     *
     * @return void
     */
    private function text_style (): void {
        $style = 'w3-input w3-round ';

        $this->text_border ($style);

        $this->text_color ($style);

        $this->text_align ($style);

        /* set style attributes */
        $this->textAttr .= 'class="' . $style . '" ';

        /* set outline style */
        $this->textAttr .= $this->text_outline ();
    }

    /**
     * Set zero value for outline style
     *
     * @return string
     */
    private function text_outline (): string {
        return 'style="outline: 0;" ';
    }

    /**
     * Set border & border color for input text
     *
     * @param string $style
     * @return void
     */
    private function text_border (&$style): void {
        if ($this->txtBorderColor) {
            $style .= 'w3-border w3-border-' . $this->txtBorderColor . ' ';
        }
    }

    /**
     * Set background & text color for input text
     *
     * @param type $style
     * @return void
     */
    private function text_color (&$style): void {
        $style .= $this->txtColor ? 'w3-' . $this->txtColor . ' ' : '';
    }

    /**
     * Set text alignment
     *
     * @return void
     */
    private function text_align (&$style): void {
        $style .= 'w3-' . $this->align . '-align ';
    }

    /* ----------------------------------------------------------------------
     * Final - Generate input
     * ----------------------------------------------------------------------
     */

    /**
     * Creating input text
     *
     * @return string
     */
    private function create_input_text (): string {
        return "<section class='w3-rest'>"
                . '<input type="search" ' . $this->textAttr . '/>'
                . "</section>";
    }

}
