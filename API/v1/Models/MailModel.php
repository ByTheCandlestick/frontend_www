<?php
	class MailModel extends BaseModel {
        /** Send
         *  @return
         */
		public function Send(string $f, string $t, string $c, string $b, string $s, string $m) {
            // headers
            $h  = "From: The Candlestick <$f>\r\n";
            $h .= "MIME-Version: 1.0\r\n";
            $h .= "Content-Type: text/html; charset=UTF-8\r\n";
            $h .= "Cc:\r\n";
            $h .= "Bcc:\r\n";
            // Send the message
            $sent = mail($t, $s, $m, $h);
            if($sent) {
                return $this->Execute("INSERT INTO `Mail`(`From`, `To`, `Cc`, `Bcc`, `Subject`, `Message`, `Archived?`, `Status`) VALUES ('$f', '$t', '$c', '$b', '$s', '$m', '0', 'Sent')", 1);
            } else {
                $this->Execute("INSERT INTO `Mail`(`From`, `To`, `Cc`, `Bcc`, `Subject`, `Message`, `Archived?`, `Status`) VALUES ('$f', '$t', '$c', '$b', '$s', '$m', '0', 'Error')", 4);
                return false;
            }
		}
		/** Archive
		 * @return
		 */
		public function Archive(string $f, string $t, string $c, string $b, string $s, string $m) {
            $this->Execute("INSERT INTO `Mail`(`From`, `To`, `Cc`, `Bcc`, `Subject`, `Message`, `Archived?`, `Status`) VALUES ('$f', '$t', '$c', '$b', '$s', '$m', '1', 'Unsent')", 4);
		}
	}
?>