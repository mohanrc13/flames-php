<?php

/*
 * Rc's PHP Flames Program
 */

class rc_flames{
	
	private $m_name;
	private $f_name;
	private $final_m_name;
	private $final_f_name;
	private $letters_count;
		
	function __construct( $m_name, $f_name ) {
		$this->m_name = $this->final_m_name = !empty( $m_name ) ? str_split( $m_name ) : '';
		$this->f_name = $this->final_f_name = !empty( $f_name ) ? str_split( $f_name ) : '';
	}
	
	public function rc_get_matching_flames(){
		$m_name = $this->m_name;
		$f_name = $this->f_name;
		if( !empty( $m_name ) && !empty( $f_name ) ){
			for( $i = 0; $i < count( $m_name ); $i++ ){
				$res = in_array( $m_name[$i], $f_name );
				if( $res !== false ){
					$m_pos = array_search( $m_name[$i], $m_name );
					$f_pos = array_search( $m_name[$i], $f_name );
					unset( $this->final_m_name[$m_pos] );
					unset( $this->final_f_name[$f_pos] );
				}
			}
			$this->letters_count = $this->rc_get_remain_letter_count();
			if( $this->letters_count == 0 ){
				echo "You getting good pair. !Flames not available for Zero(0).";
			}else{
				$this->rc_flames_process();
			}
		}else{
			echo "!Oops. Must give both of the names.";
		}
	}

	public function rc_get_remain_letter_count(){
		$m_name = $this->final_m_name;
		$f_name = $this->final_f_name;
		$mingle_count = count( $m_name ) + count( $f_name );
		return $mingle_count;
	}
	
	public function rc_flames_process( $word = 'flames' ){
		$letters_count = $this->letters_count;		;
		$remain_flames = $letters_count;
		if( $letters_count > strlen( $word ) ){
			if( $letters_count % strlen( $word ) != 0 ){
				$div_val = $letters_count / strlen( $word );
				$tot_flames = floor( $div_val );
				$remain_flames = $letters_count - ( floor( $div_val ) * strlen( $word ) );
			}else{
				$remain_flames = strlen( $word );
			}
		}
		$arr_word = str_split($word);
		
		$word = str_replace( $arr_word[$remain_flames-1], "", $word );
		if( ( $remain_flames - 1 ) ){
			$sec_word = substr( $word,( $remain_flames - 1 ) );
			$first_word = str_replace( $sec_word, "", $word );
			$word = $sec_word . $first_word;
			
		}
		if( strlen( $word ) == 1 ){
			$this->rc_flames_output( $word );
		}else{
			$this->rc_flames_process( $word );
		}
	}
	
	public function rc_flames_output( $letter ){
		switch( $letter ){
			case "f": echo "Friends"; break;
			case "l": echo "Love"; break;
			case "a": echo "Affection"; break;
			case "m": echo "Marriage"; break;
			case "e": echo "Enemies"; break;
			case "s": echo "Sister & Brother"; break;
		}
	}
	
}

$flames = new rc_flames( 'ajith', 'shalini' );
$flames->rc_get_matching_flames();