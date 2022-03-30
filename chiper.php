<?php
class Cipher {
    /**
     * algoritma yang akan digunakan.
     *
     * @access  private
     * @var     string
     */
    private $algo;
    /**
     * mode enkripsi.
     *
     * @access  private
     * @var     string
     */
    private $mode;
    /**
     * pengacakan inputan data.
     *
     * @access  private
     * @var     integer
     */
    private $source;

    /**
     * inisialisasi vektor.
     *
     * @access  private
     * @var     string
     */
    private $iv = null;

    /**
     * Kunci Enkripsi.
     *
     * @access  private
     * @var     string
     */
    private $key = null;

    /**
     * Cipher($algo, $mode, $source)
     *
     * konstruktor chiper. mengatur algoritma dan enkripsi yang akan digunakan.
     *
     * @param   string $algo
     * @param   string $mode
     * @param   integer $source (pengacakan data)
     * @access  public
     * @return  void
     */
    public function __construct($algo = MCRYPT_3DES, $mode = MCRYPT_MODE_CBC, $source = MCRYPT_RAND) {
        $this->algo = $algo;
        $this->mode = $mode;
        $this->source = $source;

        if (is_null($this->algo) || (strlen($this->algo) == 0)) {
            $this->algo = MCRYPT_3DES;
        }
        if (is_null($this->mode) || (strlen($this->mode) == 0)) {
            $this->mode = MCRYPT_MODE_CBC;
        }
    }

    /**
     * Proses encrypt($data, $key, $iv)
     *
     * proses enkripsi $data, menggunakan base64 encoded. $key yang digunakan harus spesifik dan jika 
	 tidak dimasukan maka proses enkripsi tidak bisa dilakukan.
     *
     * @param   string $data
     * @param   mixed $key
     * @param   string $iv
     * @access  public
     * @return  string
     */
    public function encrypt($data, $key = null, $iv = null) {
        $key = (strlen($key) == 0) ? $key = null : $key;

        $this->setKey($key);
        $this->setIV($iv);

        $out = mcrypt_encrypt($this->algo, $this->key, $data, $this->mode, $this->iv);
        return base64_encode($out);
    }

    /**
     * Proses deskripsi($data, $key, $iv)
     *
     * Proses deskripsi $data. $key yang digunakan harus spesifik dan jika
	 tidak dimasukan makan proses deskripsi tidak dapat dilakukan.
     *
     * @param   mixed $data
     * @param   mixed $key
     * @param   string $iv
     * @access  public
     * @return  string
     */
    public function decrypt($data, $key = null, $iv = null) {
        $key = (strlen($key) == 0) ? $key = null : $key;

        $this->setKey($key);
        $this->setIV($iv);

        $data = base64_decode($data);
        $out = mcrypt_decrypt($this->algo, $this->key, $data, $this->mode, $this->iv);
        return trim($out);
    }

    /**
     * getIV()
     *
     * proses IV digunakan untuk  encryption sehingga kamu dapat menginputkan 
	  chiper text. 
     *
     * @access  public
     * @return  string
     */
    public function getIV() {
        return base64_encode($this->iv);
    }

    /**
     * setIV($iv)
     *
     * Mengatur IV. apabila $iv spesifik maka proses dapat berjalan, jika tidak 
	 maka proses masukan chiper text tidak dapat berlangsung.
     *
     * @param   string $iv
     * @access  private
     * @return  void
     */
    private function setIV($iv) {
        if (!is_null($iv)) {
            $this->iv = base64_decode($iv);
        }
        if (is_null($this->iv)) {
            $iv_size = mcrypt_get_iv_size($this->algo, $this->mode);
            $this->iv = mcrypt_create_iv($iv_size, $this->source);
        }
    }

    /**
     * setKey($data, $key)
     *
     * pengaturan Cipher::kunci. ini digunakan untuk memasukan kunci yang akan digunakan dalam enkripsi dan deskripsi.
     * jika kunci tidak di inputkan maka, proses tidak dapat berlangsung.
     * tidak ada inisialisasi kunci. 
     *
     * @param   mixed $key
     * @access  private
     * @return  void
     */
    private function setKey($key) {
        if (!is_null($key)) {
            $key_size = mcrypt_get_key_size($this->algo, $this->mode);
            $this->key = hash("sha256", $key, true);
            $this->key = substr($this->key, 0, $key_size);
        }
        if (is_null($this->key)) {
            trigger_error("You must specify a key at least once in either Cipher::encrpyt() or Cipher::decrypt().", E_USER_ERROR);
        }
    }
}
?>