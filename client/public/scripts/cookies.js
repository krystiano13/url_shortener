export const setCookie = (name,value,expires) => {
    const date = new Date();
    date.setTime(date.getTime() + expires * 24 * 60 * 60 * 1000);
    const expire = `expires=${date.toUTCString()}`;
    document.cookie = `${name}=${value}; ${expire}; path=/`;
}

export const deleteCookie = (name) => {
    setCookie(name, null, null);
}

export const getCookie = (name) => {
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookies = decodedCookie.split("; ");

    cookies.forEach(item => {
        if(item.indexOf(name) == 0) {
            return item.substring(name.length + 1);
        }
    });

    return null;
}