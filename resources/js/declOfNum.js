export default function declOfNum(value, text_forms) {
    value = Math.abs(value) % 100;
    let n1 = value % 10;
    if (value > 10 && value < 20) { return text_forms[2]; }
    if (n1 > 1 && n1 < 5) { return text_forms[1]; }
    if (n1 === 1) { return text_forms[0]; }

    return text_forms[2];
}
