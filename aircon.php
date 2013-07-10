<?php

require_once(dirname(__FILE__) . '/lirc.php');

/**
begin remote

  name  aircon
  bits           16
  flags SPACE_ENC|CONST_LENGTH
  eps            30
  aeps          100

  header       8882  4299
  one           602  1551
  zero          602   446
  ptrail        605
  repeat       8881  2100
  pre_data_bits   16
  pre_data       0x7F
  gap          104483
  min_repeat      1
  toggle_bit_mask 0x0

      begin codes
          KEY_POWER                0x20DF
          KEY_CHANNELDOWN          0x609F
          KEY_CHANNELUP            0xA05F
          KEY_CYCLEWINDOWS         0x00FF
          KEY_NEXT                 0xE01F
          KEY_TIME                 0x807F
      end codes

end remote
 */
class aircon extends lirc {
	public function __construct() {
		parent::__construct('aircon');
	}

	public function power() { $this->sendKey('KEY_POWER'); return $this; }
	public function tempDown() { $this->sendKey('KEY_CHANNELDOWN'); return $this; }
	public function tempUp() { $this->sendKey('KEY_CHANNELUP'); return $this; }
	public function timer() { $this->sendKey('KEY_TIME'); return $this; }
	public function speed() { $this->sendKey('KEY_NEXT'); return $this; }
	public function mode() { $this->sendKey('KEY_CYCLEWINDOWS'); return $this; }
	public function sleep($time) { sleep($time); return $this; }
}

?>