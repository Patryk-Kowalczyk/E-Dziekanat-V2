import React, {useState} from 'react';
import Input from "./Input";

const Form = ({element}) => {
    const [isOpenForm, setOpenForm] = useState(false);
    const [formMarks, formMarksUpdate] = useState(element.marks);

    const [isVisible, setIsVisible] = useState(false);
    const [visibleValueDesc, setVisibleValueDesc] = useState('');
    const [visibleValueMark, setVisibleValueMark] = useState('');


    const handleOnChangeDescription = (e) => {
        const edit = [...formMarks];
        edit[e.target.placeholder].description = e.target.value;
        formMarksUpdate(edit)
    }
    const handleOnChangeMark = (e) => {
        const edit = [...formMarks];
        edit[e.target.placeholder].mark = e.target.value;
        formMarksUpdate(edit)
    }
    const handleOnClick = (e) => {

    }
    return (
        <>
            <div key={element.unique_number} className="nameLastName" onClick={() => setOpenForm(!isOpenForm)}>
                {element.first_name + " " + element.last_name}
            </div>
            {isOpenForm && (
                <div className="marksForm">
                    <form>
                        {formMarks.map((e, i) => {
                            return (
                                <div>
                                    <Input valueI={i}
                                           valueInput={formMarks[i].description}
                                           handleOnChange={handleOnChangeDescription}/>
                                    <Input valueI={i}
                                           valueInput={formMarks[i].mark}
                                           handleOnChange={handleOnChangeMark}/>
                                    <br/>
                                </div>
                            )
                        })}
                        {isVisible === true ? (
                                <>
                                    <input type="text" className="inputForm" value={visibleValueDesc}
                                           onChange={setVisibleValueDesc}
                                           placeholder={"Kategoria"}/>
                                    <input type="text" className="inputForm" value={visibleValueMark}
                                           onChange={setVisibleValueMark}
                                           placeholder={"Ocena"}
                                    />

                                </>
                            )
                            : null}
                        <div className="divPlus" onClick={() => setIsVisible(!isVisible)}>+</div>
                        <button className="buttonForm">Submit</button>
                    </form>
                </div>
            )}
        </>
    );
};

export default Form;
