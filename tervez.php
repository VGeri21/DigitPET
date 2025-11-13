<!DOCTYPE html>
<html lang="hu">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DigitPet Biléta Tervező</title>
<link rel="stylesheet" href="style.css">
<style>
:root {
  /* Biléta oldal változók */
  --bileta-alapszin-vilagos: #00FF00;
  --bileta-alapszin-kozeps: #32CD32;
  --bileta-alapszin-sotet: #228B22;

  --bileta-szoveg-szin: #ffffff;
  --bileta-kiemelo-szin: #000000;

  --bileta-kartya-hatter: rgba(255,255,255,0.1);
  --bileta-kartya-arnyek: 0 8px 20px rgba(0,0,0,0.2);
}

.bileta-oldal {
  font-family: 'Segoe UI', Tahoma, sans-serif;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  background: linear-gradient(135deg, var(--bileta-alapszin-vilagos), var(--bileta-alapszin-kozeps), var(--bileta-alapszin-sotet));
  color: var(--bileta-szoveg-szin);
  min-height: 100vh;
}

.bileta-oldal h2 {
  margin-bottom: 20px;
  font-size: 2rem;
  text-shadow: 1px 1px 5px rgba(0,0,0,0.3);
}

.bileta-kartya {
  background: var(--bileta-kartya-hatter);
  backdrop-filter: blur(10px);
  border-radius: 20px;
  padding: 20px;
  max-width: 400px;
  width: 100%;
  text-align: center;
  box-shadow: var(--bileta-kartya-arnyek);
}

.bileta-kartya svg {
  width: 80%;
  max-width: 300px;
  height: auto;
  margin: 20px auto;
}

.bileta-kartya text {
  font-weight: bold;
  text-anchor: middle;
  dominant-baseline: middle;
  pointer-events: none;
}

.bileta-kartya .controls {
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.bileta-kartya label {
  font-weight: 600;
  margin-bottom: 5px;
  display: block;
}

.bileta-kartya select, .bileta-kartya input {
  padding: 8px 12px;
  border-radius: 8px;
  border: none;
  font-size: 1rem;
  width: 100%;
}

.bileta-kartya input[type="color"] {
  padding: 0;
  height: 40px;
  width: 60px;
  cursor: pointer;
}
</style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="bileta-oldal">
  <h2>🐾 DigitPet Biléta Tervező</h2>

  <div class="bileta-kartya">
    <svg id="elonezet" viewBox="0 0 250 250">
      <circle id="forma-kor" cx="125" cy="125" r="100" fill="#00FF00" stroke="#000000" stroke-width="10" style="display:none"/>
      <rect id="forma-negyzet" x="25" y="25" width="200" height="200" rx="20" fill="#00FF00" stroke="#000000" stroke-width="10" style="display:none"/>
      <path id="forma-csont" d="M40,125 Q10,80 40,35 Q60,10 90,30 Q110,50 125,50 Q140,50 160,30 Q190,10 210,35 Q240,80 210,125 Q190,150 160,130 Q140,110 125,110 Q110,110 90,130 Q60,150 40,125 Z" fill="#00FF00" stroke="#000000" stroke-width="10"/>
      
      <!-- Kutya neve -->
      <text id="kutya-nev" x="125" y="125" fill="#000000" font-size="22">KUTYA NÉV</text>

      <!-- DigitPet felirat mindig látható -->
      <text id="digitpet" x="125" y="210" fill="#000000" font-size="14">DigitPet</text>
    </svg>

    <div class="controls">
      <div>
        <label>Forma:</label>
        <select id="forma">
          <option value="csont">Csont</option>
          <option value="kor">Kör</option>
          <option value="negyzet">Négyzet</option>
        </select>
      </div>

      <div>
        <label>Alap színe:</label>
        <input type="color" id="alapszin" value="#00FF00">
      </div>

      <div>
        <label>Keret és szöveg színe:</label>
        <input type="color" id="kiemelo-szin" value="#000000">
      </div>

      <div>
        <label>Kutya neve:</label>
        <input type="text" id="nev" value="KUTYA NÉV">
      </div>
    </div>
  </div>
</div>

<script>
const formak = {
  kor: document.getElementById('forma-kor'),
  negyzet: document.getElementById('forma-negyzet'),
  csont: document.getElementById('forma-csont')
};

const kutyaNevEl = document.getElementById('kutya-nev');
const digitPetEl = document.getElementById('digitpet');
const formaSelect = document.getElementById('forma');
const alapszin = document.getElementById('alapszin');
const kiemeloSzin = document.getElementById('kiemelo-szin');
const nevInput = document.getElementById('nev');

function frissitElonezet() {
  // Forma kiválasztása
  for (let key in formak) {
    formak[key].style.display = (key === formaSelect.value) ? 'block' : 'none';
    formak[key].setAttribute('fill', alapszin.value);
    formak[key].setAttribute('stroke', kiemeloSzin.value);
  }

  // Kutya neve
  kutyaNevEl.setAttribute('fill', kiemeloSzin.value);
  kutyaNevEl.textContent = nevInput.value || "KUTYA NÉV";

  // DigitPet felirat mindig látszik, színe a kiemelő szín
  digitPetEl.setAttribute('fill', kiemeloSzin.value);
  digitPetEl.setAttribute('x', '125');

  if (formaSelect.value === 'csont') {
    kutyaNevEl.setAttribute('x', '125');
    kutyaNevEl.setAttribute('y', '75');
    digitPetEl.setAttribute('y', '95');
  } else {
    kutyaNevEl.setAttribute('x', '125');
    kutyaNevEl.setAttribute('y', '125');
    digitPetEl.setAttribute('y', '210');
  }
}

[formaSelect, alapszin, kiemeloSzin, nevInput].forEach(el => el.addEventListener('input', frissitElonezet));
frissitElonezet();
</script>

</body>
</html>
