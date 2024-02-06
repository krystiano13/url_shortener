import './Form.css';
export function Form() {
    return (
        <section className="w-full p-6 lg:pr-36 lg:pl-36 flex justify-center items-center mt-24">
            <form className="w-full p-12 flex gap-4 justify-center rounded-xl">
                <input className="w-[80%] p-4 outline-none rounded-xl text-lg font-small" type="text" placeholder="Shorten link here..." />
                <button
                    id="btn"
                    className="w-[20%] p-4 text-white font-big rounded-xl cursor-pointer transition-colors"
                    type="submit"
                >
                    Shorten It!
                </button>
            </form>
        </section>
    )
}
