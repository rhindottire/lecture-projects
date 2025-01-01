function hitungBMI(berat, tinggi) {
    tinggi /= 100;
    const bmi = berat / (tinggi * tinggi);
    return bmi.toFixed(2);
}

function kategoriBMI(bmi) {
    if (bmi < 18.5) {
        return "Kurus";
    } else if (bmi >= 18.5 && bmi < 25) {
        return "Normal";
    } else if (bmi >= 25 && bmi < 30) {
        return "Gemuk";
    } else {
        return "Obesitas";
    }
}

function tampilkanBMI() {
    const berat = parseFloat(document.getElementById("berat").value);
    const tinggi = parseFloat(document.getElementById("tinggi").value);

    if (isNaN(berat) || isNaN(tinggi) || berat <= 0 || tinggi <= 0) {
        alert("Masukkan berat dan tinggi yang valid.");
        return;
    }

    const bmi = hitungBMI(berat, tinggi);
    const kategori = kategoriBMI(bmi);

    const hasil =
        "BMI Anda adalah " + bmi + ". Anda termasuk dalam kategori: " + kategori;
    document.getElementById("hasil").innerHTML = hasil;
}
