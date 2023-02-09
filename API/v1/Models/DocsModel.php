<?php
	class DocsModel extends BaseModel {
		/** getOrderInfo
		 * 
		 */
			public function getOrderInfo(string $inv) {
				return $this->Execute(sprintf("SELECT * FROM `Transactions` WHERE `Type`='Order' AND `Invoice ID`='%s' LIMIT 1", $inv), 4)[0];
			}
		/** getItemInfo
		 * 
		 */
			public function getItemInfo(string $itemStr) {
				$i=$t=0;
				foreach(array_filter(explode(';', $itemStr)) as $itemInfo){
					$item = explode(',', $itemInfo);
					$inf = $this->Execute(sprintf("SELECT `Title`, `RetailPrice` FROM `Product` WHERE `SKU`='%s'", $item[0]), 3);
					$t = $t+($item[1]*$inf[1]);
					$arr[$i] = array($inf[0], $item[1], $inf[1], $item[1]*$inf[1]);
					$i++;
				}
				$arr[$i] = array('totalRow', $t, '', '');
				return $arr;
			}
		/** getUserAddress
		 * 
		 */
			public function getUserAddress(string $id) {
				return $this->Execute(sprintf("SELECT * FROM `User addresses` WHERE `id`='%s'", $id), 4)[0];
			}
		/** get_currency_symbol
		 * 
		 */
			function get_currency_symbol($string) {
				$fmt = new NumberFormatter( "en-gb@currency=".$string, NumberFormatter::CURRENCY);
				$curr = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
				$symbol = '';
				$length = mb_strlen($curr, 'utf-8');
				for ($i = 0; $i < $length; $i++) {
					$char = mb_substr($curr, $i, 1, 'utf-8');
					if (!ctype_digit($char) && !ctype_punct($char))
						$symbol .= $char;
				}
				return $symbol;
			}
	}
?>