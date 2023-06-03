<?php
namespace App\Libraries\Form\LSearch\Handlers;

trait Submit
{
    /**
     * To hold submit name & id
     * 
     * @var string
     */
    public string $submitName = 'btn_search';
    
    /**
     * Submit background & text color <p>valid value is: name of a color</p>
     * 
     * @var string
     */
    public string $submitColor = 'green';
    
    /**
     * To hold submit value attribute
     * 
     * @var string
     */
    public string $submitValue = 'Search';
    
    /**
     * Submit width style
     * 
     * @var string
     */
    public string $submitWidth = '100';
    
    /**
     * To hold all attributes for input submit
     * 
     * @var string
     */
    private string $submitAttr = '';
    
    /* ------------------------------------------------------------ */
    
    /**
     * Generate input submit
     * 
     * @return string
     */
    protected function generate_submit (): string {
        $this->setup_submit ();
        
        return $this->create_input_submit ();
    }
    
    /* ----------------------------------------------------------------------
     * Setup
     * ----------------------------------------------------------------------
     */
    
    /**
     * Setup name, id, value & style attributes
     * 
     * @return void
     */
    private function setup_submit (): void {
        $this->submit_name();
        
        $this->submit_value();
        
        $this->submit_style ();
        
        $this->submit_encode ();
    }
    
    /**
     * Set submit name & id
     * 
     * @return void
     */
    private function submit_name (): void {
        $this->submitAttr .= 'name="' . $this->submitName . '" ';
        $this->submitAttr .= 'id="' . $this->submitName . '" ';
    }
    
    /**
     * Set submit value
     * 
     * @return void
     */
    private function submit_value (): void {
        $this->submitAttr .= 'value="'. $this->submitValue . '" ';
    }
    
    /* ----------------------------------------------------------------------
     * Setup style
     * ----------------------------------------------------------------------
     */
    
    /**
     * Set color, align & width style
     * 
     * @return void
     */
    private function submit_style (): void {
        /* Deafult style */
        $style = 'class="w3-round w3-col w3-button ';
        
        $this->submit_color ($style);
        
        $this->submit_align ($style);
        
        /* End of class attribute */
        $style .= '" ';
        
        $this->submit_width ($style);
        
        /* Set result */
        $this->submitAttr .= $style;
    }
    
    /**
     * Set background color
     * 
     * @param string $style
     * @return void
     */
    private function submit_color (&$style): void {
        if ($this->submitColor) {
            $style .= 'w3-' . $this->submitColor 
                . ' w3-hover-' . $this->submitColor . ' ';
        }
    }
    
    /**
     * Set submit width by style attributes, not class
     * 
     * @param type $style
     * @return void
     */
    private function submit_width (&$style): void {
        $style .= $this->submitWidth ? 'style="width: ' . $this->submitWidth . 'px; " ' : null;
    }
    
    /**
     * Floating submit to left | right
     * 
     * @param type $style
     * @return void
     */
    private function submit_align (&$style): void {
        if ($this->align == 'left') {
            $style .= 'w3-right ';
        } elseif ($this->align == 'right') {
            $style .= 'w3-left ';
        }
        
        /* set margin */
        $this->submit_margin ($style);
    }
    
    /**
     * Set margin for submit
     * 
     * @return string
     */
    private function submit_margin (&$style): void {
        $style .= 'w3-margin-' . $this->align . ' ';
    }
    
    /* ----------------------------------------------------------------------
     * Encode
     * ----------------------------------------------------------------------
     */
    
    private function submit_encode (): void {
        $this->submitAttr .= 'formenctype="application/x-www-form-urlencoded" ';
    }
    
    /* ----------------------------------------------------------------------
     * Final - Create input
     * ----------------------------------------------------------------------
     */
    
    /**
     * Create input submit
     * 
     * @return string
     */
    private function create_input_submit (): string {
        return '<input type="submit" '. $this->submitAttr . ' />';
    }
}
