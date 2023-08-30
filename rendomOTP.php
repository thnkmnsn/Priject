<?php

class OTPGenerator {
    const OTP_LENGTH = 6;

    public static function generateOTP() {
        $sb = "";
        for ($i = 0; $i < self::OTP_LENGTH; $i++) {
            $digit = rand(0, 9);
            $sb .= strval($digit);
        }
        return $sb;
    }

    public static function main() {
        $otp = self::generateOTP();
        echo "Your OTP is: " . $otp;
    }
}

OTPGenerator::main();

?>