import brandImage from '../../images/icon-brand-recognition.svg';
import recordsImage from '../../images/icon-detailed-records.svg';
import customizableImage from '../../images/icon-fully-customizable.svg';

type Benefit = {
    img: ImageMetadata,
    alt: string,
    title: string,
    desc: string
}

export const Benefits:Benefit[] = [
    {
        img : brandImage,
        alt : "Brand Image",
        title : "Brand Recognition",
        desc : "Boost your brand recognition with each click. Generic links don't mean a thing. Branded links help instill confidence in your content"
    },
    {
        img : recordsImage,
        alt : "Detailed Records Icon",
        title : "Detailed Records",
        desc : "Gain Insights into who is clicking your links. Knowing when and where people engage with your content helps inform better descisions"
    },
    {
        img : customizableImage,
        alt : "Customizable Image",
        title : "Fully Customizable",
        desc : "Improve brand awareness and content discoverability trough customizable links, supercharging audience engagement"
    },
];