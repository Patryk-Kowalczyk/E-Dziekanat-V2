import React, {useState} from 'react';
import Input from "./Input";
import {useDispatch} from "react-redux";
import {setClasses} from "../../../../actions/classes";
import data from "../../endpoints/marks.json";

const Form = ({element}) => {
    const [isOpenForm, setOpenForm] = useState(false);
    const [formMarks, formMarksUpdate] = useState(element.marks);

    const [isVisible, setIsVisible] = useState(false);
    const [visibleValueDesc, setVisibleValueDesc] = useState('');
    const [visibleValueMark, setVisibleValueMark] = useState();


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
        e.preventDefault()
        const edit = [...formMarks];
        if(visibleValueMark){
            edit[edit.length] = {
                id: edit.length,
                mark: Number(visibleValueMark),
                description: visibleValueDesc,
            }
        }
        formMarksUpdate(edit)
        setVisibleValueMark();
        setVisibleValueDesc('');
        setIsVisible(false);
        console.log(edit);
        // eslint-disable-next-line react-hooks/rules-of-hooks

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
                                    <input type="text" className="inputForm"
                                           value={visibleValueDesc}
                                           onChange={(e) => setVisibleValueDesc(e.target.value)}
                                           placeholder={"Kategoria"}/>
                                    <input type="text" className="inputForm" value={visibleValueMark}
                                           onChange={(e) => setVisibleValueMark(e.target.value)}
                                           placeholder={"Ocena"}
                                    />

                                </>
                            )
                            : null}
                        {isVisible === false ? (
                            <div className="divPlus" onClick={() => setIsVisible(!isVisible)}>+</div>
                        ) : <div className="divPlus" onClick={() => setIsVisible(!isVisible)}>-</div>}
                        <button onClick={handleOnClick} className="buttonForm">Submit</button>
                    </form>
                </div>
            )}
        </>
    );
};

export default Form;
