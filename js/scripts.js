function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input[required]');
    let valid = true;

    inputs.forEach(input => {
        if (!input.value.trim()) {
            alert(`${input.name} es obligatorio`);
            valid = false;
        }
    });

    return valid;
}

function calculateCalories() {
    const weight = parseFloat(document.getElementById('weight').value);
    const height = parseFloat(document.getElementById('height').value);
    const age = parseInt(document.getElementById('age').value);
    const gender = document.getElementById('gender').value;
    const activityLevel = document.getElementById('activityLevel').value;

    if (!weight || !height || !age || !gender || !activityLevel) {
        alert('Por favor, completa todos los campos');
        return;
    }

    let bmr;
    if (gender === 'male') {
        bmr = 88.362 + (13.397 * weight) + (4.799 * height) - (5.677 * age);
    } else {
        bmr = 447.593 + (9.247 * weight) + (3.098 * height) - (4.330 * age);
    }

    const activityFactors = {
        'sedentary': 1.2,
        'lightly_active': 1.375,
        'moderately_active': 1.55,
        'very_active': 1.725,
        'extra_active': 1.9
    };

    const tdee = bmr * activityFactors[activityLevel];

    document.getElementById('calorieResult').innerHTML = `
        <h4>Resultados:</h4>
        <p><strong>BMR (Tasa Metabólica Basal):</strong> ${Math.round(bmr)} kcal/día</p>
        <p><strong>TDEE (Gasto Energético Diario):</strong> ${Math.round(tdee)} kcal/día</p>
        <p><strong>Recomendaciones:</strong></p>
        <ul>
            <li>Para mantener tu peso: Consume ~${Math.round(tdee)} kcal/día.</li>
            <li>Para perder peso: Reduce a ~${Math.round(tdee * 0.85)} kcal/día.</li>
            <li>Para ganar peso: Aumenta a ~${Math.round(tdee * 1.15)} kcal/día.</li>
        </ul>
    `;
}