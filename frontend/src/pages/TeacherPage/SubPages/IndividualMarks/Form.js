import React, {useState} from 'react';
import Input from "./Input";
import {useDispatch} from "react-redux";
import {setClasses} from "../../../../actions/classes";
import data from "../../endpoints/marks.json";

const Form = ({element,infoGroup,infoForm,infoSubject}) => {
    const [isOpenForm, setOpenForm] = useState(false);
    const [formMarks, formMarksUpdate] = useState(element.marks);

    const [isVisible, setIsVisible] = useState(false);
    const [visibleValueCategory, setVisibleValueCategory] = useState('');
    const [visibleValueMark, setVisibleValueMark] = useState();
    const [visibleValueComment, setVisibleValueComment] = useState('');



    const handleOnChangeCategory = (e) => {
        const edit = [...formMarks];
        edit[e.target.placeholder].category = e.target.value;
        formMarksUpdate(edit)
    }
    const handleOnChangeComments = (e) => {
        const edit = [...formMarks];
        edit[e.target.placeholder].comments = e.target.value;
        formMarksUpdate(edit)
    }
    const handleOnChangeMark = (e) => {
        const edit = [...formMarks];
        edit[e.target.placeholder].mark = Number(e.target.value);
        formMarksUpdate(edit)
    }
    const handleOnClick = (e) => {
        e.preventDefault()
        console.log(infoForm)
        const info = {
            "group_id": infoGroup,
            "subject": infoSubject,
            "form": infoForm,
        }

        const edit = [...formMarks];
        if(visibleValueMark){

            edit[edit.length] = {
                id: edit.length,
                mark: Number(visibleValueMark),
                category: visibleValueCategory,
                comments: visibleValueComment,
                date:''
            }
        }
        formMarksUpdate(edit)
        const editAndInfo = [info,...edit]
        const myJsonString = JSON.stringify(editAndInfo);

        setVisibleValueMark();
        setVisibleValueCategory('');
        setVisibleValueComment('');
        setIsVisible(false);
        console.log(myJsonString);
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
                        <input className="inputForm" value={"Kategoria"} disabled/>
                        <input className="inputForm" value={"Ocena"} disabled/>
                        <input className="inputForm" value={"Komentarz"} disabled/>
                        {formMarks.map((e, i) => {
                            return (
                                <div>
                                    <Input valueI={i}
                                           valueInput={formMarks[i].category}
                                           handleOnChange={handleOnChangeCategory
                                           }/>
                                    <Input valueI={i}
                                           valueInput={formMarks[i].mark}
                                           handleOnChange={handleOnChangeMark}
                                    />
                                    <Input valueI={i}
                                           valueInput={formMarks[i].comments}
                                           handleOnChange={handleOnChangeComments}
                                    />
                                    <br/>

                                </div>
                            )
                        })}
                        {isVisible === true ? (
                                <>
                                    <input type="text" className="inputForm"
                                           value={visibleValueCategory}
                                           onChange={(e) => setVisibleValueCategory(e.target.value)}
                                           placeholder={"Kategoria"}/>
                                    <input type="text" className="inputForm" value={visibleValueMark}
                                           onChange={(e) => setVisibleValueMark(e.target.value)}
                                           placeholder={"Ocena"}
                                    />
                                    <input type="text" className="inputForm" value={visibleValueComment}
                                           onChange={(e) => setVisibleValueComment(e.target.value)}
                                           placeholder={"Komentarz"}
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
