import React, { memo } from "react";
import {SafeAreaView, View, ScrollView} from 'react-native'
import Background from '../components/Background';
import InfoTab from "../components/InfoTab";
import ProfileTab from "../components/ProfileTab";
import { styles } from "../core/Theme";
import { post } from "../core/Utils";
import {useDispatch, useSelector} from 'react-redux'
import { setOrphanage } from "../actions";
import ContactTab from "../components/ContactTab";

const OrphanageProfileScreen = ({ navigation, route }) => {

    const [loaded, setLoaded] = React.useState(false);
    const [contacts, setContacts] = React.useState();
    const [name, setName] = React.useState();
    const dispatch = useDispatch();
    const orphanage = useSelector( state => state.orphanage );

    React.useEffect(() => {
        if (route.params?.name && !name ) {
            setName(route.params.name);
        }

        if (!loaded){
            _loadOrphanage();
            // console.log(id)
        }
    })

    const _loadOrphanage = async () => {

        const json = await post(
            'http://localhost/fto_api/orphanage/read_where.php',
            {
                // type : "name",
                name : name 
            }
        );

        if( json.status === true ) {
            dispatch(setOrphanage(json.record));
            setLoaded(true);
            _loadContacts(json.record.id);
        }
    }

    const _loadContacts = async (id) => {

        const result = await post(
            'http://localhost/fto_api/contact/read.php',
            {
                orphanageId: id
            }
        );

        if (result.status === true ) {
            setContacts(result.records);
        }

    }

    const _showMap = () => {
        navigation.navigate('MyArea', {
            coords: { lat: orphanage.latitude, lng: orphanage.longitude}
        })
    }

    const _onDonate = () => {
        navigation.navigate('Donate', {
            contacts: contacts,
            orphanageName: name
        });
    }

    return (
        <Background>
            <View style={[styles.container, { flexDirection: 'column',  width: '100%'}]} >
                <ScrollView style={{ width: '100%'}} contentContainerStyle={{ padding: 5}} >
                    <ProfileTab name={orphanage.name} showMap={_showMap} district={orphanage.district} donate={_onDonate} />
                    <View>
                        <ContactTab title='contact' contacts={contacts} />
                        <InfoTab title='vision' text={orphanage.vision} />
                        <InfoTab title='mission' text={orphanage.mission} />
                    </View>
                </ScrollView>
            </View>
        </Background>
    )
}

export default memo(OrphanageProfileScreen);