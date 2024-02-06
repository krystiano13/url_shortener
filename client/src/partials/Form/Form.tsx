import './Form.css';
import shortenImage1 from '../../images/bg-shorten-desktop.svg';
import shortenImage2 from '../../images/bg-shorten-mobile.svg';
export function Form() {
    return (
        <section id="formWrapper" className="w-full p-6 lg:pr-36 lg:pl-36 flex justify-center items-center mt-24">
            <form className="w-full relative h-32 flex gap-4 justify-center items-center rounded-xl">
                <img
                    src={shortenImage1.src as string}
                    alt="background of form"
                    className="absolute w-full h-full rounded-xl hidden md:block"
                />
                <img
                    src={shortenImage2.src as string}
                    alt="background of form"
                    className="absolute w-full h-full rounded-xl block md:hidden"
                />
                <input className="w-[72%] h-2/5 z-50 p-4 outline-none rounded-xl text-lg font-small" type="text"
                       placeholder="Shorten link here..."/>
                <button
                    id="btn"
                    className="w-[18%] z-50 text-base h-2/5  p-4 text-white font-big rounded-xl cursor-pointer transition-colors"
                    type="submit"
                >
                    Shorten It!
                </button>
            </form>
        </section>
    )
}
