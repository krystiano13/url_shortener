import Cookies from 'universal-cookie';

import type {FunctionComponent} from "preact";
import { useState, useRef } from 'preact/hooks';
import './AccountForm.css';
interface Props {
    mode: "login" | "register"
}

export const AccountForm:FunctionComponent<Props> = ({ mode }) => {
    const [errors, setErrors] = useState<string[]>([]);

    const usernameInput = useRef<HTMLInputElement>(null);
    const emailInput = useRef<HTMLInputElement>(null);
    const password1Input = useRef<HTMLInputElement>(null);
    const password2Input = useRef<HTMLInputElement>(null);

    function handleSubmit(e:SubmitEvent) {
        e.preventDefault();
        const data = new FormData();

        data.append("username", (usernameInput.current as HTMLInputElement).value);
        data.append("password1", (password1Input.current as HTMLInputElement).value);

        if(mode === "register") {
            data.append("email", (emailInput.current as HTMLInputElement).value);
            data.append("password2", (password2Input.current as HTMLInputElement).value);
        }

        setErrors([]);

        fetch(`http://localhost:8000/${mode}`, {
            method : "POST",
            body: data
        })
            .then(res => res.json())
            .then(data => {
                const err:string[] = [];
                if(data.errors) {
                    data.errors.forEach((item:string) => {
                        err.push(item);
                    })
                }
                if(data.message) {
                    if(mode === "register") {
                        window.location.href = '/login';
                    }
                    else {
                        const cookie = new Cookies();
                        const today = new Date();

                        // @ts-ignore
                        cookie.set("username", data.username, { expires : today.getTime() + 86400000 });
                        // @ts-ignore
                        cookie.set("token", data.token, { expires : today.getTime() + 86400000 });

                        window.location.href = '/';
                    }
                }
                setErrors(err);
            })
    }

    return (
        <form onSubmit={handleSubmit} className="flex flex-col items-center justify-center gap-8 p-9 pt-16 pb-16 rounded-xl">
            <label className="font-small">
                <span>Username</span> <br/>
                <input ref={usernameInput} required className="outline-none font-small" type="text" name="username"/>
            </label>
            {
                mode === "register" &&
                <label className="font-small">
                    <span>Email</span> <br/>
                    <input ref={emailInput} required className="outline-none font-small" type="email" name="email"/>
                </label>
            }
            <label className="font-small">
                <span>Password</span> <br/>
                <input ref={password1Input} required className="outline-none font-small" type="password" name="password1"/>
            </label>
            {
                mode === "register" &&
                <label className="font-small">
                    <span>Repeat Password</span> <br/>
                    <input ref={password2Input} required className="outline-none font-small" type="password" name="password2"/>
                </label>
            }
            <button className="font-small w-[80%] text-white bg-cyan p-2 pl-4 pr-4 rounded-xl" type="submit">
                { mode === "login" ? "Log In" : "Register" }
            </button>
            {
                errors.map(item => (
                    <p className="text-red-500 font-small">{ item }</p>
                ))
            }
        </form>
    )
}