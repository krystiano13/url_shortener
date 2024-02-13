import type {FunctionComponent} from "preact";
import { useState } from 'preact/hooks';
import './AccountForm.css';
interface Props {
    mode: "login" | "register"
}

export const AccountForm:FunctionComponent<Props> = ({ mode }) => {
    const errors = useState<string[]>([]);
    return (
        <form className="flex flex-col items-center justify-center gap-8 p-9 pt-16 pb-16 rounded-xl">
            <label className="font-small">
                <span>Username</span> <br/>
                <input required className="outline-none font-small" type="text" name="username"/>
            </label>
            {
                mode === "register" &&
                <label className="font-small">
                    <span>Email</span> <br/>
                    <input required className="outline-none font-small" type="email" name="email"/>
                </label>
            }
            <label className="font-small">
                <span>Password</span> <br/>
                <input required className="outline-none font-small" type="password" name="password1"/>
            </label>
            {
                mode === "register" &&
                <label className="font-small">
                    <span>Repeat Password</span> <br/>
                    <input required className="outline-none font-small" type="password" name="password2"/>
                </label>
            }
            <button className="font-small w-[80%] text-white bg-cyan p-2 pl-4 pr-4 rounded-xl" type="submit">Register
            </button>
        </form>

    )
}