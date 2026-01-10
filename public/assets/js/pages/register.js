import debounce from "../utils/debounce.js";

export default () => {
    console.log("validation loaded");

    const form = document.querySelector(".auth-form");
    if (!form) return;

    const emailInput = form.querySelector('input[name="email"]');
    const password1Input = form.querySelector('input[name="password1"]');
    const password2Input = form.querySelector('input[name="password2"]');
    const firstNameInput = form.querySelector('input[name="firstname"]');
    const lastNameInput = form.querySelector('input[name="lastname"]');

    function markValidation(element, condition) {
        !condition
            ? element.classList.add("no-valid")
            : element.classList.remove("no-valid");
    }

    function isEmail(email) {
        return /\S+@\S+\.\S+/.test(email);
    }

    function isStrongPassword(password) {
        return password.length >= 6;
    }

    function arePasswordsSame(p1, p2) {
        return p1 === p2 && p2.length > 0;
    }

    function isValidName(value) {
        return /^[A-Za-zĄĆĘŁŃÓŚŹŻąćęłńóśźż -]{2,}$/.test(value);
    }

    const validateEmail = debounce(() => {
        markValidation(emailInput, isEmail(emailInput.value));
    });

    const validatePasswordStrength = debounce(() => {
        markValidation(password1Input, isStrongPassword(password1Input.value));
    });

    const validatePasswordMatch = debounce(() => {
        markValidation(
            password2Input,
            arePasswordsSame(password1Input.value, password2Input.value)
        );
    });

    const validateFirstName = debounce(() => {
        markValidation(firstNameInput, isValidName(firstNameInput.value));
    });

    const validateLastName = debounce(() => {
        markValidation(lastNameInput, isValidName(lastNameInput.value));
    });

    emailInput.addEventListener("keyup", validateEmail);
    password1Input.addEventListener("keyup", validatePasswordStrength);
    password2Input.addEventListener("keyup", validatePasswordMatch);
    firstNameInput.addEventListener("keyup", validateFirstName);
    lastNameInput.addEventListener("keyup", validateLastName);

    form.addEventListener("submit", (e) => {
        const valid =
            isEmail(emailInput.value) &&
            isStrongPassword(password1Input.value) &&
            arePasswordsSame(password1Input.value, password2Input.value) &&
            isValidName(firstNameInput.value) &&
            isValidName(lastNameInput.value);

        if (!valid) {
            e.preventDefault();
            alert("Please correct the highlighted fields.");
        }
    });
};
