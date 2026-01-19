import logo from '../assets/logo.svg';

export function Header() {
    return (
        <header className="bg-background py-4 px-6">
            <nav className="flex items-center justify-between mx-28">
                <img src={logo} alt="Logo" className="h-16"/>
                <div className='flex gap-12 items-center'>
                    <a href="" className='text-[#544845] font-semibold tracking-wider'>Perguntas Frequentes</a>
                    <a href="" className='text-[#544845] font-semibold tracking-wider'>Seja um Apoiador</a>
                    <button className='bg-[#F2430D] px-4 py-2 text-white font-semibold tracking-wider shadow-[5px_5px_0px_1px_rgba(0,_0,_0,_0.4)]'>SE INSCREVA</button>
                </div>
            </nav>
        </header>
    );
}
