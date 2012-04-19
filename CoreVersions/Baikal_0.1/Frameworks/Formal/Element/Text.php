<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2012 Jérôme Schneider <mail@jeromeschneider.fr>
*  All rights reserved
*
*  http://baikal.codr.fr
*
*  This script is part of the Baïkal Server project. The Baïkal
*  Server project is free software; you can redistribute it
*  and/or modify it under the terms of the GNU General Public
*  License as published by the Free Software Foundation; either
*  version 2 of the License, or (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

namespace Formal\Element;

class Text extends \Formal\Element {
	
	protected function inputtype() {
		return "text";
	}
	
	public function render() {
		$disabled = "";
		$inputclass = "";
		$groupclass = "";
		$placeholder = "";
		
		$value = $this->value();
		$label = $this->option("label");
		$prop = $this->option("prop");
		$placeholder = "";
		$helpblock = "";
		$popover = "";
		
		if($this->option("readonly") === TRUE) {
			$inputclass .= " disabled";
			$disabled = " disabled";
		}
		
		if($this->option("error") === TRUE) {
			$groupclass .= " error";
		}
		
		if(($sPlaceHolder = trim($this->option("placeholder"))) !== "") {
			$placeholder = " placeholder=\"" . htmlspecialchars($sPlaceHolder) . "\" ";
		}
		
		$clientvalue = htmlspecialchars($value);
		
		$sInputType = $this->inputtype();
		
		if(($sHelp = trim($this->option("help"))) !== "") {
			$helpblock = "<p class=\"help-block\">" . $sHelp . "</p>";
		}
		
		if(($aPopover = $this->option("popover")) !== "") {
			$inputclass .= " popover-focus ";
			$popover = " title=\"" . htmlspecialchars($aPopover["title"]) . "\" ";
			$popover .= " data-content=\"" . htmlspecialchars($aPopover["content"]) . "\" ";
		}
		
		$sHtml =<<<HTML
<div class="control-group{$groupclass}">
	<label class="control-label" for="{$prop}">{$label}</label>
	<div class="controls">
		<input type="{$sInputType}" class="input-xlarge{$inputclass}" id="{$prop}" name="{$prop}" value="{$clientvalue}"{$disabled}{$placeholder}{$popover}/>
		{$helpblock}
	</div>
</div>
HTML;
		return $sHtml;
	}
}