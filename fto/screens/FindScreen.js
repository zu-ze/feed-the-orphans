import React, { useState } from "react";
import { View, Button } from "react-native";
import {ActivityIndicator} from "react-native-paper";
import Background from "../components/Background";
import TextInput from "../components/TextInput";
import {styles} from '../core/Theme'
import { nameValidator, get } from "../core/Utils";

export const FindScreen = ({navigation}) => {
    const [keyword, setKeyword] = useState({ value: '', error: ''})
    const [isLoading, setLoading] = React.useState(false)

    const _onSearch = async () => {
        const keywordError = nameValidator(keyword.value);

        if ( keywordError ) {
            setKeyword({...keyword, error: keywordError});
            return;
        }

        const json = await get(
            'http://localhost/fto_api/search/search_orphanage.php?query='+ keyword.value);

        console.log(json);

        setLoading(false)
        navigation.navigate('Result', {
            response: json,
        })
    } 

    React.useEffect(() => {

    })

    return (
        <Background>
            {isLoading?<ActivityIndicator/>
            :
                <View style={[styles.container, {flexDirection: "column" }]} >
                    <View>
                        <TextInput
                            label="Search"
                            returnKeyType="done"
                            value={keyword.value}
                            onChangeText={ text => setKeyword({ value: text, error: '' })}
                            error={!!keyword.error}
                            errorText={keyword.error}
                        />
                    </View>
                    <View>
                        <View style={{paddingTop: 5}} >
                            <Button
                                title="Done"
                                onPress={ () => {
                                    setLoading(true)
                                    _onSearch();
                                }}
                            />
                        </View>
                    </View>
                </View>
            }
        </Background>
    )
} 
