import React, {useState} from 'react';
import Input from "../IndividualMarks/Input";
import header from "../../../../services/auth-header";
import axios from "axios";
import API_URL from "../../../../services/API_URL";
import {setClasses} from "../../../../actions/classes";
import {setMarks} from "../../../../actions/marks";
import {useDispatch} from "react-redux";

const Form = ({element}) => {
    const [isOpenForm, setOpenForm] = useState(false);
    const [firstTerm, setFirstTerm] = useState(element.first_term || '');
    const [firstRepeat, setFirstRepeat] = useState(element.first_repeat || '');
    const [secondRepeat, setSecondRepeat] = useState(element.second_repeat ||'');
    const [committee, setCommittee] = useState(element.committee ||'');
    const [promotion, setPromotion] = useState(element.promition || '');
    const dispatch = useDispatch()
    const handleOnClick = (e) => {
        e.preventDefault()
        const info = {
            id_finalgrade: element.id_finalgrade,
            first_term: firstTerm === '' ? null : Number(firstTerm),
            first_repeat: firstRepeat === '' ? null : Number(firstRepeat),
            second_repeat: secondRepeat === '' ? null : Number(secondRepeat),
            committee: committee === '' ? null : Number(committee),
            promotion: promotion === '' ? null : Number(promotion),
        }

        const config = {
            headers: header(),
        };
        axios
            .post(API_URL + "educator/finalGradesStore",info, config)
            .then((response) => {
                console.log(response);
            })
            .catch((err) => console.error(err));

        axios
            .get(API_URL + "educator/finalGradesList",config)
            .then((response) => {
                const data = response.data;
                console.log(data)
                dispatch(
                    setMarks({
                        finalGrades: data.finalGrades,
                    }))


            })
            .catch((err) => console.error(err));
    }
    return (
        <>
            <div key={element.unique_number} className="nameLastName" onClick={() => setOpenForm(!isOpenForm)}>
                {element.first_name + " " + element.last_name + " -- Grupa --- " + element.group }
            </div>
            {isOpenForm && (
                <div className="marksForm">
                    <form>
                        <label>Ocena końcowa:{" "}
                            <br/>
                            <input type="number" className="inputForm"
                                   value={firstTerm}
                                   onChange={(e) => setFirstTerm(e.target.value)}
                            />
                        </label>
                        <br/>
                        <br/>
                        <label>Pierwsza poprawka:{" "}
                            <br/>
                            <input type="number" className="inputForm"
                                   value={firstRepeat}
                                   onChange={(e) => setFirstRepeat(e.target.value)}

                            />
                        </label>
                        <br/>
                        <br/>
                        <label>Druga Poprawka:{" "}
                            <br/>
                            <input type="number" className="inputForm"
                                   value={secondRepeat}
                                   onChange={(e) => setSecondRepeat(e.target.value)}

                            />
                        </label>
                        <br/>
                        <br/>
                        <label>Komis:{" "}
                            <br/>
                            <input type="number" className="inputForm"
                                   value={committee}
                                   onChange={(e) => setCommittee(e.target.value)}

                            />

                        </label>
                        <br/>
                        <br/>
                        <label>Awans:{" "}
                            <br/>
                            <input type="number" className="inputForm"
                                   value={promotion}
                                   onChange={(e) => setPromotion(e.target.value)}

                            />

                        </label>
                        <br/>
                        <br/>
                        <button onClick={handleOnClick} className="buttonForm">Submit</button>
                    </form>
                </div>
            )}
        </>
    );
};

export default Form;
