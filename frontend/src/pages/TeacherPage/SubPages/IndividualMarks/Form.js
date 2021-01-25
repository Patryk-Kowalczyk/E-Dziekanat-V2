import React, {useState,useEffect} from 'react';
import Input from "./Input";
import axios from "axios";
import API_URL from "../../../../services/API_URL";
import header from "../../../../services/auth-header";


const Form = ({element,infoGroup,infoForm,s_id}) => {
    useEffect(()=>{
        formMarksUpdate([...element.marks])
    },[element])


    const [isOpenForm, setOpenForm] = useState(false);
    const [formMarks, formMarksUpdate] = useState([]);
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
        edit[e.target.placeholder].value = Number(e.target.value);
        formMarksUpdate(edit)
    }
    const handleOnClick = (e) => {
        e.preventDefault()
        console.log(infoForm)
        const info = {
            "subject_id": s_id,
            "album": element.album,
        }

        const edit = [...formMarks];
        if(visibleValueMark){

            edit[edit.length] = {
                id:"new",
                value: Number(visibleValueMark),
                category: visibleValueCategory,
                comments: visibleValueComment,
                date:''
            }
        }
        formMarksUpdate(edit)
        const editAndInfo = [info,...edit]

        const config = {
            headers: header(),
        };
        axios
            .post(API_URL + "educator/partialGradesStore",editAndInfo, config)
            .then((response) => {
                console.log(response);
            })
            .catch((err) => console.error(err));

        setVisibleValueMark();
        setVisibleValueCategory('');
        setVisibleValueComment('');
        setIsVisible(false);
        // eslint-disable-next-line react-hooks/rules-of-hooks

    }
    return (
        <>
            <div key={element.unique_number} className="nameLastName" onClick={() => setOpenForm(!isOpenForm)}>
                {element.first_name + " " + element.last_name + " -- Grupa -- " + infoGroup}
            </div>
            {isOpenForm && (
                <div className="marksForm">
                    <form>
                        <input className="inputForm" value={"Kategoria"} disabled/>
                        <input className="inputForm" value={"Ocena"} disabled/>
                        <input className="inputForm" value={"Komentarz"} disabled/>
                        {[...formMarks].map((e, i) => {
                            return (
                                <div>
                                    <Input valueI={i}
                                           valueInput={formMarks[i].category}
                                           handleOnChange={handleOnChangeCategory
                                           }/>
                                    <Input valueI={i}
                                           valueInput={formMarks[i].value}
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
