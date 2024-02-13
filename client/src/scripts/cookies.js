const setCookie = (name,value,expires) => {
    const date = new Date();
    date.setTime(date.getTime() + expires * 24 * 60 * 60 * 1000);
    const expire = `expires=${date.toUTCString()}`;
    document.cookie = `${name}=${value};${expire}`;
}