PGDMP     4        	            z            omaped    13.2    13.2 R               0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    31682    omaped    DATABASE     a   CREATE DATABASE omaped WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE = 'Spanish_Peru.1252';
    DROP DATABASE omaped;
                postgres    false            �            1255    40114 2   sp_actualizar_ruta_pdf(integer, character varying)    FUNCTION     �   CREATE FUNCTION public.sp_actualizar_ruta_pdf(id_t integer, route character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
begin
	update tb_tramite set tram_archivo=route where tram_id=id_t;
	return 1;
end;
$$;
 T   DROP FUNCTION public.sp_actualizar_ruta_pdf(id_t integer, route character varying);
       public          postgres    false            �            1255    40112 1   sp_buscar_beneficiario_representante_pdf(integer)    FUNCTION     �	  CREATE FUNCTION public.sp_buscar_beneficiario_representante_pdf(id_t integer) RETURNS TABLE(id_pe integer, dni_pe character, nombre_pe character varying, apepat_pe character varying, apemat_pe character varying, fecha_pe date, sexo_pe character, telefono_pe character varying, correo_pe character varying, numcertdisc character varying, tipo_pe character, estado_pe character, dependiente_pe integer, id_esci integer, denominacion_esci character varying, direccion_pe character varying, id_grin integer, denominacion_grin character varying, id_ubig integer, provincia_ubig character varying, distrito_ubig character varying, tram_descripcion character varying)
    LANGUAGE plpgsql
    AS $$
declare
pers_id_b int:=(select pers_id from tb_tramite where tram_id=id_t);
repre_id int:= (select pers_dependiente from tb_persona where pers_id=pers_id_b );
bene_count int:= (select count(*) from tb_persona where pers_id=pers_id_b );
begin
	if repre_id!=0 then
		return query
		select pe.pers_id,pe.pers_dni,pe.pers_nombre,pe.pers_apelpat,pe.pers_apelmat,
		pe.pers_fechanac, pe.pers_sexo,pe.pers_telefono,pe.pers_correo,pe.pers_numcertdisc,pe.pers_tipo,
		pe.pers_estado,pe.pers_dependiente,es.esci_id,es.esci_denominacion, pe.pers_direccion,gr.grin_id,gr.grin_denominacion,
		ub.ubig_id,ub.ubig_provincia ,ub.ubig_distrito, tp.titr_denominacion
		from tb_persona as pe
		inner join tb_estado_civil as es on pe.esci_id=es.esci_id
		inner join tb_grado_instruccion as gr on gr.grin_id=pe.grin_id
		inner join tb_ubigeo as ub on ub.ubig_id=pe.ubig_id
		left join tb_tramite as tt on tt.pers_id=pe.pers_id
		left join tb_tipo_tramite as tp on tt.titr_id=tp.titr_id
		where pe.pers_id=pers_id_b or pe.pers_id=repre_id;
	else
		return query
		select pe.pers_id,pe.pers_dni,pe.pers_nombre,pe.pers_apelpat,pe.pers_apelmat,
		pe.pers_fechanac, pe.pers_sexo,pe.pers_telefono,pe.pers_correo,pe.pers_numcertdisc,pe.pers_tipo,
		pe.pers_estado,pe.pers_dependiente,es.esci_id,es.esci_denominacion, pe.pers_direccion, gr.grin_id,gr.grin_denominacion,
		ub.ubig_id,ub.ubig_provincia ,ub.ubig_distrito, tp.titr_denominacion
		from tb_persona as pe
		inner join tb_estado_civil as es on pe.esci_id=es.esci_id
		inner join tb_grado_instruccion as gr on gr.grin_id=pe.grin_id
		inner join tb_ubigeo as ub on ub.ubig_id=pe.ubig_id
		inner join tb_tramite as tt on tt.pers_id=pe.pers_id
		inner join tb_tipo_tramite as tp on tt.titr_id=tp.titr_id
		where pe.pers_id=pers_id_b;
	end if;
end;
$$;
 M   DROP FUNCTION public.sp_buscar_beneficiario_representante_pdf(id_t integer);
       public          postgres    false            �            1255    40011 %   sp_buscar_descrpcion_tramite(integer)    FUNCTION     ?  CREATE FUNCTION public.sp_buscar_descrpcion_tramite(id_t integer) RETURNS TABLE(denominacion character varying)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select tp.titr_denominacion as denominacion from tb_tramite as tr
	inner join tb_tipo_tramite as tp on tr.titr_id=tp.titr_id
	where tram_id=id_t;
end;
$$;
 A   DROP FUNCTION public.sp_buscar_descrpcion_tramite(id_t integer);
       public          postgres    false            �            1255    40000    sp_buscar_tutor(character)    FUNCTION     F  CREATE FUNCTION public.sp_buscar_tutor(dni character) RETURNS TABLE(id_p integer, nombre text, tipo character, estado character)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select pers_id, pers_nombre||' '||pers_apelpat||' '||pers_apelmat as nombre,pers_tipo, pers_estado
	from tb_persona where pers_dni=dni;
end;
$$;
 5   DROP FUNCTION public.sp_buscar_tutor(dni character);
       public          postgres    false            �            1255    40160    sp_buscar_tutor_id(integer)    FUNCTION     �   CREATE FUNCTION public.sp_buscar_tutor_id(id_t integer) RETURNS TABLE(nombre text)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select pers_nombre||' '||pers_apelpat||' '||pers_apelmat as nombre
	from tb_persona where pers_id=id_t;
end;
$$;
 7   DROP FUNCTION public.sp_buscar_tutor_id(id_t integer);
       public          postgres    false            �            1255    31783 %   sp_listar_distrito(character varying)    FUNCTION     �   CREATE FUNCTION public.sp_listar_distrito(prov character varying) RETURNS TABLE(distrito character varying)
    LANGUAGE plpgsql
    AS $$

begin
	return query
	select ubig_distrito from tb_ubigeo where ubig_provincia=prov;
end;
$$;
 A   DROP FUNCTION public.sp_listar_distrito(prov character varying);
       public          postgres    false            �            1255    31760    sp_listar_estado_civil()    FUNCTION     �   CREATE FUNCTION public.sp_listar_estado_civil() RETURNS TABLE(id_ec integer, denominacion_ec character varying, abreviatura_ec character, estado_ec character)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select * from tb_estado_civil;
end;
$$;
 /   DROP FUNCTION public.sp_listar_estado_civil();
       public          postgres    false            �            1255    31770    sp_listar_grado_instruccion()    FUNCTION     �   CREATE FUNCTION public.sp_listar_grado_instruccion() RETURNS TABLE(id_gi integer, denominacion_gi character varying, estado_gi character)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select * from tb_grado_instruccion;
end;
$$;
 4   DROP FUNCTION public.sp_listar_grado_instruccion();
       public          postgres    false            �            1255    40109    sp_listar_persona()    FUNCTION     �  CREATE FUNCTION public.sp_listar_persona() RETURNS TABLE(id_pe integer, dni_pe character, nombre_pe character varying, apepat_pe character varying, apemat_pe character varying, fecha_pe date, sexo_pe character, telefono_pe character varying, correo_pe character varying, numcertdisc character varying, tipo_pe character, estado_pe character, dependiente_pe integer, id_esci integer, denominacion_esci character varying, direccion_pe character varying, id_grin integer, denominacion_grin character varying, id_ubig integer, provincia_ubig character varying, distrito_ubig character varying)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select pe.pers_id,pe.pers_dni,pe.pers_nombre,pe.pers_apelpat,pe.pers_apelmat,
	pe.pers_fechanac, pe.pers_sexo,pe.pers_telefono,pe.pers_correo,pe.pers_numcertdisc,pe.pers_tipo,
	pe.pers_estado,pe.pers_dependiente,es.esci_id,es.esci_denominacion,pe.pers_direccion ,gr.grin_id,gr.grin_denominacion,
	ub.ubig_id,ub.ubig_provincia ,ub.ubig_distrito
	from tb_persona as pe
	inner join tb_estado_civil as es on pe.esci_id=es.esci_id
	inner join tb_grado_instruccion as gr on gr.grin_id=pe.grin_id
	inner join tb_ubigeo as ub on ub.ubig_id=pe.ubig_id;
	
end;
$$;
 *   DROP FUNCTION public.sp_listar_persona();
       public          postgres    false            �            1255    31782    sp_listar_provincia()    FUNCTION     �   CREATE FUNCTION public.sp_listar_provincia() RETURNS TABLE(provincia character varying)
    LANGUAGE plpgsql
    AS $$
begin
	return query 
	select distinct(ubig_provincia) from tb_ubigeo;
end;
$$;
 ,   DROP FUNCTION public.sp_listar_provincia();
       public          postgres    false            �            1255    31774    sp_listar_tipo_tramite()    FUNCTION     �   CREATE FUNCTION public.sp_listar_tipo_tramite() RETURNS TABLE(id_tm integer, denominacion_tm character varying, estado_tm character)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select * from tb_tipo_tramite;
end;
$$;
 /   DROP FUNCTION public.sp_listar_tipo_tramite();
       public          postgres    false            �            1255    31814    sp_listar_tramite()    FUNCTION     t  CREATE FUNCTION public.sp_listar_tramite() RETURNS TABLE(id_t integer, fecha_t date, tipo_t integer, tipo_t_denominacion character varying, persona_t integer, persona_t_nombre text, persona_t_dni character, archivo_t character varying)
    LANGUAGE plpgsql
    AS $$
begin
	return query
	select tram.tram_id,tram.tram_fechareg,tram.titr_id,tp.titr_denominacion,
	tb.pers_id,tb.pers_nombre||' '||tb.pers_apelpat||' '||tb.pers_apelmat as nombre, tb.pers_dni,
	tram.tram_archivo
	from tb_tramite as tram
	inner join tb_tipo_tramite as tp on tram.titr_id=tp.titr_id
	inner join tb_persona as tb on tram.pers_id=tb.pers_id;
end;
$$;
 *   DROP FUNCTION public.sp_listar_tramite();
       public          postgres    false            �            1255    48355    sp_listar_usuario()    FUNCTION     �  CREATE FUNCTION public.sp_listar_usuario() RETURNS TABLE(idusu integer, dniusu character, apepatusu character varying, apematusu character varying, correousu character varying, usua_nombre character varying, usua_clave character varying, usua_estado character, nombre text, usua_level character varying)
    LANGUAGE plpgsql
    AS $$
Begin
return query
select 
tbusu.usua_id idusu,
tbusu.usua_dni dniusu,
tbusu.usua_apelpat apepatusu,
tbusu.usua_apelmat apematusu,
tbusu.usua_correo correousu,
tbusu.usua_nombre,
tbusu.usua_clave,
tbusu.usua_estado,
concat(tbusu.usua_apelpat,' ', tbusu.usua_apelmat,' ',tbusu.usua_nombre) as nombre, 
tbusu.usua_nivel
from tb_usuario tbusu order by usua_id desc;

END;
$$;
 *   DROP FUNCTION public.sp_listar_usuario();
       public          postgres    false            �            1255    40004 7   sp_modificar_contra_usuario(integer, character varying)    FUNCTION     �   CREATE FUNCTION public.sp_modificar_contra_usuario(idusu integer, contra character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
Begin
  
     UPDATE public.tb_usuario 
	 SET usua_clave=contra 
	 where usua_id=idusu;
	 return 1;
	
END;
$$;
 [   DROP FUNCTION public.sp_modificar_contra_usuario(idusu integer, contra character varying);
       public          postgres    false            �            1255    31769 K   sp_modificar_estado_civil(integer, character varying, character, character)    FUNCTION     '  CREATE FUNCTION public.sp_modificar_estado_civil(id_e integer, denom character varying, abriev character, est character) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
cantD int := (select count(*) from tb_estado_civil where upper(esci_denominacion)=upper(denom));
nombreA character varying:=(select upper(esci_denominacion) from tb_estado_civil where esci_id=id_e);
begin
	if nombreA=upper(denom) then
		UPDATE public.tb_estado_civil
		SET esci_denominacion=upper(denom), esci_abreviatura=upper(abriev), esci_estado=upper(est)
		WHERE esci_id=id_e;
		return 1;
	else
		if cantD = 0 then
			UPDATE public.tb_estado_civil
			SET esci_denominacion=upper(denom), esci_abreviatura=upper(abriev), esci_estado=upper(est)
			WHERE esci_id=id_e;
			return 1;
		else
			return 2;
		end if;
	end if;
end;
$$;
 x   DROP FUNCTION public.sp_modificar_estado_civil(id_e integer, denom character varying, abriev character, est character);
       public          postgres    false            �            1255    31773 E   sp_modificar_grado_instruccion(integer, character varying, character)    FUNCTION     �  CREATE FUNCTION public.sp_modificar_grado_instruccion(id_g integer, denom character varying, est character) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
cantD int:=(select count(*) from tb_grado_instruccion where upper(grin_denominacion)=upper(denom)) ;
nombreA character varying:=(select upper(grin_denominacion) from tb_grado_instruccion where grin_id=id_g);
begin
	if nombreA=upper(denom) then
		UPDATE public.tb_grado_instruccion
		SET grin_denominacion=upper(denom), grin_estado= upper(est)
		WHERE grin_id=id_g;
		return 1;
	else
		if cantD = 0 then
			UPDATE public.tb_grado_instruccion
			SET grin_denominacion=upper(denom), grin_estado= upper(est)
			WHERE grin_id=id_g;
			return 1;
		else
			return 2;
		end if;
	end if;

end;
$$;
 k   DROP FUNCTION public.sp_modificar_grado_instruccion(id_g integer, denom character varying, est character);
       public          postgres    false            �            1255    40111   sp_modificar_persona(integer, character, character varying, character varying, character varying, date, character, character varying, character varying, character varying, character, character, integer, integer, character varying, integer, character varying)    FUNCTION     �  CREATE FUNCTION public.sp_modificar_persona(id_p integer, dni character, nombre character varying, apepat character varying, apemat character varying, fecha date, sexo character, telefono character varying, correo character varying, numcertdisc character varying, tipo character, estado character, dependiente integer, id_esci integer, direcc character varying, id_grin integer, distrito character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare 
contP int:=(select count(*) from tb_persona where upper(pers_dni)=upper(dni) );
dniP character varying:=(select pers_dni from tb_persona where (pers_id)=(id_p));
cod int;
begin
	select ubig_id into cod from tb_ubigeo where ubig_distrito=distrito;
	if dniP=dni then
		UPDATE tb_persona
		SET  pers_dni=dni, pers_nombre=upper(nombre), pers_apelpat=upper(apepat), pers_apelmat=upper(apemat), pers_fechanac=fecha,
		pers_sexo=upper(sexo), pers_telefono=telefono, 
		pers_correo=upper(correo), pers_numcertdisc=numcertdisc, pers_tipo=upper(tipo), pers_estado=upper(estado), pers_dependiente=dependiente, 
		esci_id=id_esci, grin_id=id_grin, ubig_id=cod, pers_direccion=upper(direcc)
		WHERE pers_id=id_p;
		return 1;
	else
		if contP=0 then
			UPDATE public.tb_persona
			SET  pers_dni=dni, pers_nombre=upper(nombre), pers_apelpat=upper(apepat), pers_apelmat=upper(apemat), pers_fechanac=fecha,
			pers_sexo=upper(sexo), pers_telefono=telefono, 
			pers_correo=upper(correo), pers_numcertdisc=numcertdisc, pers_tipo=upper(tipo), pers_estado=upper(estado), pers_dependiente=dependiente, 
			esci_id=id_esci, grin_id=id_grin, ubig_id=cod, pers_direccion=upper(direcc)
			WHERE pers_id=id_p;
			return 1;
		else
			return 2;
		end if;
	end if;
end;
$$;
 �  DROP FUNCTION public.sp_modificar_persona(id_p integer, dni character, nombre character varying, apepat character varying, apemat character varying, fecha date, sexo character, telefono character varying, correo character varying, numcertdisc character varying, tipo character, estado character, dependiente integer, id_esci integer, direcc character varying, id_grin integer, distrito character varying);
       public          postgres    false            �            1255    31776 @   sp_modificar_tipo_tramite(integer, character varying, character)    FUNCTION     �  CREATE FUNCTION public.sp_modificar_tipo_tramite(id_t integer, denom character varying, est character) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
cantD int:=(select count(*) from tb_tipo_tramite where upper(titr_denominacion)=upper(denom)) ;
nombreA character varying:=(select upper(titr_denominacion) from tb_tipo_tramite where titr_id=id_t);
begin
	if nombreA=upper(denom) then
		UPDATE public.tb_tipo_tramite
		SET titr_denominacion=upper(denom), titr_estado= upper(est)
		WHERE titr_id=id_t;
		return 1;
	else
		if cantD = 0 then
			UPDATE public.tb_tipo_tramite
			SET titr_denominacion=upper(denom), titr_estado= upper(est)
			WHERE titr_id=id_t;
			return 1;
		else
			return 2;
		end if;
	end if;

end;
$$;
 f   DROP FUNCTION public.sp_modificar_tipo_tramite(id_t integer, denom character varying, est character);
       public          postgres    false            �            1255    48356 �   sp_modificar_usuario(integer, character, character varying, character varying, character varying, character varying, character varying, character varying)    FUNCTION     �  CREATE FUNCTION public.sp_modificar_usuario(idusu integer, dni character, nombre character varying, apepat character varying, apemat character varying, email character varying, contra character varying, nivel character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE 
   cant integer= (select count(*)from tb_usuario where usua_dni=dni);
   correocant integer = (select count(*) from tb_usuario where usua_correo=email);
   dnib integer = (select usua_id from tb_usuario where usua_dni=dni);
   crreo integer = (select usua_id from tb_usuario where usua_correo=email);
   
Begin
  	if cant=0 and correocant=0 then
		UPDATE public.tb_usuario SET usua_dni=dni, usua_apelpat=apepat, usua_apelmat=apemat, 
		 usua_nombre=nombre,usua_correo=email, usua_clave=contra, usua_nivel=nivel where usua_id=idusu;
		 return 1;
	else 
		if dnib=idusu then
			if crreo =idusu then 
				UPDATE public.tb_usuario SET usua_dni=dni, usua_apelpat=apepat, usua_apelmat=apemat, 
				 usua_nombre=nombre,usua_correo=email, usua_clave=contra, usua_nivel=nivel where usua_id=idusu;
				 return 1;
			else return 3;
			end if;
		else
		return 2;
		end if;
	end if;
END;
$$;
 �   DROP FUNCTION public.sp_modificar_usuario(idusu integer, dni character, nombre character varying, apepat character varying, apemat character varying, email character varying, contra character varying, nivel character varying);
       public          postgres    false            �            1255    40006 0   sp_modificar_usuario_estatus(integer, character)    FUNCTION     �   CREATE FUNCTION public.sp_modificar_usuario_estatus(idusu integer, status character) RETURNS void
    LANGUAGE plpgsql
    AS $$
DECLARE
BEGIN
	UPDATE public.tb_usuario set
	usua_estado = status
	WHERE usua_id = idusu;
END;
$$;
 T   DROP FUNCTION public.sp_modificar_usuario_estatus(idusu integer, status character);
       public          postgres    false            �            1255    48357 �   sp_registar_usuario(character, character varying, character varying, character varying, character varying, character varying, character varying)    FUNCTION     �  CREATE FUNCTION public.sp_registar_usuario(dni character, nombre character varying, apepat character varying, apemat character varying, email character varying, contra character varying, nivel character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
DECLARE 
   cant integer= (select count(*)from tb_usuario where usua_dni=dni);
   correo_existe integer= (select count(*)from tb_usuario where usua_correo=email);
Begin
  	if cant = 0 then
  		if correo_existe = 0 then
		 INSERT INTO public.tb_usuario(usua_dni, usua_apelpat, usua_apelmat, usua_nombre,usua_correo,usua_clave, usua_estado,usua_nivel)
		 values(dni,apepat,apemat,nombre,email,contra,'A',nivel);
		 return 1;
		 else return 3;
		 end if;
	else return 2;
	end if;
END;
$$;
 �   DROP FUNCTION public.sp_registar_usuario(dni character, nombre character varying, apepat character varying, apemat character varying, email character varying, contra character varying, nivel character varying);
       public          postgres    false            �            1255    31765 7   sp_registrar_estado_civil(character varying, character)    FUNCTION     �  CREATE FUNCTION public.sp_registrar_estado_civil(denom character varying, abriev character) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
contD int:=(select count(*) from tb_estado_civil where upper(esci_denominacion)=upper(denom)) ;
begin
	
	if contD=0 then
		INSERT INTO public.tb_estado_civil(
		esci_denominacion, esci_abreviatura, esci_estado)
		VALUES (upper(denom),upper(abriev),'A');
		return 1;
	else
		return 2;
	end if;
end;
$$;
 [   DROP FUNCTION public.sp_registrar_estado_civil(denom character varying, abriev character);
       public          postgres    false            �            1255    31772 1   sp_registrar_grado_instruccion(character varying)    FUNCTION     �  CREATE FUNCTION public.sp_registrar_grado_instruccion(denom character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
contD int:=(select count(*) from tb_grado_instruccion where upper(grin_denominacion)=upper(denom)) ;
begin
	if contD=0 then
		INSERT INTO public.tb_grado_instruccion(
		grin_denominacion, grin_estado)
		VALUES (upper(denom),'A');
		return 1;
	else
		return 2;
	end if;
end;
$$;
 N   DROP FUNCTION public.sp_registrar_grado_instruccion(denom character varying);
       public          postgres    false            �            1255    40110 �   sp_registrar_persona(character, character varying, character varying, character varying, date, character, character varying, character varying, character varying, character, integer, integer, character varying, integer, character varying)    FUNCTION     C  CREATE FUNCTION public.sp_registrar_persona(dni character, nombre character varying, apepat character varying, apemat character varying, fecha date, sexo character, telefono character varying, correo character varying, numcertdisc character varying, tipo character, dependiente integer, id_esci integer, direcc character varying, id_grin integer, distrito character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare 
contP int:=(select count(*) from tb_persona where upper(pers_dni)=upper(dni) and upper(pers_tipo)=tipo) ;
cod int;
begin
	select ubig_id into cod from tb_ubigeo where ubig_distrito=distrito;
	if contP=0 then
		INSERT INTO public.tb_persona(
	 	pers_dni, pers_nombre, pers_apelpat, pers_apelmat, pers_fechanac, pers_sexo, pers_telefono, 
			pers_correo, pers_numcertdisc, pers_tipo, pers_estado, pers_dependiente, esci_id, grin_id, ubig_id,pers_direccion)
		VALUES (dni,upper(nombre),upper(apepat),upper(apemat),fecha,sexo,telefono,
				upper(correo),numcertdisc,tipo,'A',dependiente,id_esci,id_grin,cod,direcc);
		return 1;
	else
		return 2;
	end if;
end;
$$;
 v  DROP FUNCTION public.sp_registrar_persona(dni character, nombre character varying, apepat character varying, apemat character varying, fecha date, sexo character, telefono character varying, correo character varying, numcertdisc character varying, tipo character, dependiente integer, id_esci integer, direcc character varying, id_grin integer, distrito character varying);
       public          postgres    false            �            1255    31775 ,   sp_registrar_tipo_tramite(character varying)    FUNCTION     �  CREATE FUNCTION public.sp_registrar_tipo_tramite(denom character varying) RETURNS integer
    LANGUAGE plpgsql
    AS $$
declare
contD int:=(select count(*) from tb_tipo_tramite where upper(titr_denominacion)=upper(denom)) ;
begin
	if contD=0 then
		INSERT INTO public.tb_tipo_tramite(
		titr_denominacion, titr_estado)
		VALUES (upper(denom),'A');
		return 1;
	else
		return 2;
	end if;
end;
$$;
 I   DROP FUNCTION public.sp_registrar_tipo_tramite(denom character varying);
       public          postgres    false            �            1255    39999 H   sp_registrar_tramite(date, character varying, integer, integer, integer)    FUNCTION     �  CREATE FUNCTION public.sp_registrar_tramite(fecha_t date, archivo_t character varying, id_titr integer, id_pers integer, id_usuario integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
begin
	INSERT INTO public.tb_tramite(
	tram_fechareg, tram_archivo, titr_id, pers_id, usuario_id)
	VALUES (fecha_t,archivo_t,id_titr,id_pers,id_usuario);
	return true;
Exception when others then return false;
end;
$$;
 �   DROP FUNCTION public.sp_registrar_tramite(fecha_t date, archivo_t character varying, id_titr integer, id_pers integer, id_usuario integer);
       public          postgres    false            �            1255    48358    sp_verificar_usuario(character)    FUNCTION     l  CREATE FUNCTION public.sp_verificar_usuario(udni character) RETURNS TABLE(usua_id integer, dni character, apelpat character varying, apelmat character varying, nombreusu character varying, usua_clave character varying, usua_estado character, nombre text, nivel character varying)
    LANGUAGE plpgsql
    AS $$
begin
return query select
usu.usua_id ,
usu.usua_dni dni ,
usu.usua_apelpat apelpat,
usu.usua_apelmat apelmat,
usu.usua_nombre nombreusu,
usu.usua_clave,
usu.usua_estado,
concat(usua_apelpat,' ',usua_apelmat,' ',usua_nombre) as nombre,
usu.usua_nivel
from public.tb_usuario usu where usua_dni= udni;
end;
$$;
 ;   DROP FUNCTION public.sp_verificar_usuario(udni character);
       public          postgres    false            �            1259    31685    tb_estado_civil    TABLE     �   CREATE TABLE public.tb_estado_civil (
    esci_id integer NOT NULL,
    esci_denominacion character varying(20) NOT NULL,
    esci_abreviatura character(1) NOT NULL,
    esci_estado character(1) NOT NULL
);
 #   DROP TABLE public.tb_estado_civil;
       public         heap    postgres    false            �            1259    31683    tb_estado_civil_esci_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_estado_civil_esci_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tb_estado_civil_esci_id_seq;
       public          postgres    false    201                       0    0    tb_estado_civil_esci_id_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tb_estado_civil_esci_id_seq OWNED BY public.tb_estado_civil.esci_id;
          public          postgres    false    200            �            1259    31693    tb_grado_instruccion    TABLE     �   CREATE TABLE public.tb_grado_instruccion (
    grin_id integer NOT NULL,
    grin_denominacion character varying(30) NOT NULL,
    grin_estado character(1) NOT NULL
);
 (   DROP TABLE public.tb_grado_instruccion;
       public         heap    postgres    false            �            1259    31691     tb_grado_instruccion_grin_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_grado_instruccion_grin_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 7   DROP SEQUENCE public.tb_grado_instruccion_grin_id_seq;
       public          postgres    false    203                       0    0     tb_grado_instruccion_grin_id_seq    SEQUENCE OWNED BY     e   ALTER SEQUENCE public.tb_grado_instruccion_grin_id_seq OWNED BY public.tb_grado_instruccion.grin_id;
          public          postgres    false    202            �            1259    31714 
   tb_persona    TABLE     �  CREATE TABLE public.tb_persona (
    pers_id integer NOT NULL,
    pers_dni character(8) NOT NULL,
    pers_nombre character varying(100) NOT NULL,
    pers_apelpat character varying(50) NOT NULL,
    pers_apelmat character varying(50) NOT NULL,
    pers_fechanac date NOT NULL,
    pers_sexo character(1) NOT NULL,
    pers_telefono character varying(9),
    pers_correo character varying(200),
    pers_numcertdisc character varying(10),
    pers_tipo character(1) NOT NULL,
    pers_estado character(1) NOT NULL,
    pers_dependiente integer NOT NULL,
    esci_id integer NOT NULL,
    grin_id integer NOT NULL,
    ubig_id integer NOT NULL,
    pers_direccion character varying(250)
);
    DROP TABLE public.tb_persona;
       public         heap    postgres    false            �            1259    31712    tb_persona_pers_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_persona_pers_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.tb_persona_pers_id_seq;
       public          postgres    false    208                       0    0    tb_persona_pers_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.tb_persona_pers_id_seq OWNED BY public.tb_persona.pers_id;
          public          postgres    false    207            �            1259    31701    tb_tipo_tramite    TABLE     �   CREATE TABLE public.tb_tipo_tramite (
    titr_id integer NOT NULL,
    titr_denominacion character varying(80) NOT NULL,
    titr_estado character(1) NOT NULL
);
 #   DROP TABLE public.tb_tipo_tramite;
       public         heap    postgres    false            �            1259    31699    tb_tipo_tramite_titr_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_tipo_tramite_titr_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 2   DROP SEQUENCE public.tb_tipo_tramite_titr_id_seq;
       public          postgres    false    205                       0    0    tb_tipo_tramite_titr_id_seq    SEQUENCE OWNED BY     [   ALTER SEQUENCE public.tb_tipo_tramite_titr_id_seq OWNED BY public.tb_tipo_tramite.titr_id;
          public          postgres    false    204            �            1259    39977 
   tb_tramite    TABLE     �   CREATE TABLE public.tb_tramite (
    tram_id integer NOT NULL,
    tram_fechareg date NOT NULL,
    tram_archivo character varying(250) NOT NULL,
    titr_id integer NOT NULL,
    pers_id integer NOT NULL,
    usuario_id integer NOT NULL
);
    DROP TABLE public.tb_tramite;
       public         heap    postgres    false            �            1259    39975    tb_tramite_tram_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_tramite_tram_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.tb_tramite_tram_id_seq;
       public          postgres    false    212                       0    0    tb_tramite_tram_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.tb_tramite_tram_id_seq OWNED BY public.tb_tramite.tram_id;
          public          postgres    false    211            �            1259    31707 	   tb_ubigeo    TABLE     �   CREATE TABLE public.tb_ubigeo (
    ubig_id integer NOT NULL,
    ubig_departamento character varying(50) NOT NULL,
    ubig_provincia character varying(50) NOT NULL,
    ubig_distrito character varying(50) NOT NULL
);
    DROP TABLE public.tb_ubigeo;
       public         heap    postgres    false            �            1259    31750 
   tb_usuario    TABLE     �  CREATE TABLE public.tb_usuario (
    usua_id integer NOT NULL,
    usua_dni character(8) NOT NULL,
    usua_apelpat character varying(50) NOT NULL,
    usua_apelmat character varying(50) NOT NULL,
    usua_nombre character varying(100) NOT NULL,
    usua_clave character varying(180) NOT NULL,
    usua_estado character(1) NOT NULL,
    usua_correo character varying(250),
    usua_nivel character varying
);
    DROP TABLE public.tb_usuario;
       public         heap    postgres    false            �            1259    31748    tb_usuario_usua_id_seq    SEQUENCE     �   CREATE SEQUENCE public.tb_usuario_usua_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 -   DROP SEQUENCE public.tb_usuario_usua_id_seq;
       public          postgres    false    210                       0    0    tb_usuario_usua_id_seq    SEQUENCE OWNED BY     Q   ALTER SEQUENCE public.tb_usuario_usua_id_seq OWNED BY public.tb_usuario.usua_id;
          public          postgres    false    209            a           2604    31688    tb_estado_civil esci_id    DEFAULT     �   ALTER TABLE ONLY public.tb_estado_civil ALTER COLUMN esci_id SET DEFAULT nextval('public.tb_estado_civil_esci_id_seq'::regclass);
 F   ALTER TABLE public.tb_estado_civil ALTER COLUMN esci_id DROP DEFAULT;
       public          postgres    false    201    200    201            b           2604    31696    tb_grado_instruccion grin_id    DEFAULT     �   ALTER TABLE ONLY public.tb_grado_instruccion ALTER COLUMN grin_id SET DEFAULT nextval('public.tb_grado_instruccion_grin_id_seq'::regclass);
 K   ALTER TABLE public.tb_grado_instruccion ALTER COLUMN grin_id DROP DEFAULT;
       public          postgres    false    203    202    203            d           2604    31717    tb_persona pers_id    DEFAULT     x   ALTER TABLE ONLY public.tb_persona ALTER COLUMN pers_id SET DEFAULT nextval('public.tb_persona_pers_id_seq'::regclass);
 A   ALTER TABLE public.tb_persona ALTER COLUMN pers_id DROP DEFAULT;
       public          postgres    false    207    208    208            c           2604    31704    tb_tipo_tramite titr_id    DEFAULT     �   ALTER TABLE ONLY public.tb_tipo_tramite ALTER COLUMN titr_id SET DEFAULT nextval('public.tb_tipo_tramite_titr_id_seq'::regclass);
 F   ALTER TABLE public.tb_tipo_tramite ALTER COLUMN titr_id DROP DEFAULT;
       public          postgres    false    204    205    205            f           2604    39980    tb_tramite tram_id    DEFAULT     x   ALTER TABLE ONLY public.tb_tramite ALTER COLUMN tram_id SET DEFAULT nextval('public.tb_tramite_tram_id_seq'::regclass);
 A   ALTER TABLE public.tb_tramite ALTER COLUMN tram_id DROP DEFAULT;
       public          postgres    false    212    211    212            e           2604    31753    tb_usuario usua_id    DEFAULT     x   ALTER TABLE ONLY public.tb_usuario ALTER COLUMN usua_id SET DEFAULT nextval('public.tb_usuario_usua_id_seq'::regclass);
 A   ALTER TABLE public.tb_usuario ALTER COLUMN usua_id DROP DEFAULT;
       public          postgres    false    210    209    210            �          0    31685    tb_estado_civil 
   TABLE DATA           d   COPY public.tb_estado_civil (esci_id, esci_denominacion, esci_abreviatura, esci_estado) FROM stdin;
    public          postgres    false    201   ǧ                  0    31693    tb_grado_instruccion 
   TABLE DATA           W   COPY public.tb_grado_instruccion (grin_id, grin_denominacion, grin_estado) FROM stdin;
    public          postgres    false    203   �                 0    31714 
   tb_persona 
   TABLE DATA           �   COPY public.tb_persona (pers_id, pers_dni, pers_nombre, pers_apelpat, pers_apelmat, pers_fechanac, pers_sexo, pers_telefono, pers_correo, pers_numcertdisc, pers_tipo, pers_estado, pers_dependiente, esci_id, grin_id, ubig_id, pers_direccion) FROM stdin;
    public          postgres    false    208   h�                 0    31701    tb_tipo_tramite 
   TABLE DATA           R   COPY public.tb_tipo_tramite (titr_id, titr_denominacion, titr_estado) FROM stdin;
    public          postgres    false    205   z�       	          0    39977 
   tb_tramite 
   TABLE DATA           h   COPY public.tb_tramite (tram_id, tram_fechareg, tram_archivo, titr_id, pers_id, usuario_id) FROM stdin;
    public          postgres    false    212   �                 0    31707 	   tb_ubigeo 
   TABLE DATA           ^   COPY public.tb_ubigeo (ubig_id, ubig_departamento, ubig_provincia, ubig_distrito) FROM stdin;
    public          postgres    false    206   %�                 0    31750 
   tb_usuario 
   TABLE DATA           �   COPY public.tb_usuario (usua_id, usua_dni, usua_apelpat, usua_apelmat, usua_nombre, usua_clave, usua_estado, usua_correo, usua_nivel) FROM stdin;
    public          postgres    false    210   ��                  0    0    tb_estado_civil_esci_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.tb_estado_civil_esci_id_seq', 32, true);
          public          postgres    false    200                       0    0     tb_grado_instruccion_grin_id_seq    SEQUENCE SET     O   SELECT pg_catalog.setval('public.tb_grado_instruccion_grin_id_seq', 15, true);
          public          postgres    false    202                       0    0    tb_persona_pers_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.tb_persona_pers_id_seq', 26, true);
          public          postgres    false    207                       0    0    tb_tipo_tramite_titr_id_seq    SEQUENCE SET     J   SELECT pg_catalog.setval('public.tb_tipo_tramite_titr_id_seq', 15, true);
          public          postgres    false    204                       0    0    tb_tramite_tram_id_seq    SEQUENCE SET     E   SELECT pg_catalog.setval('public.tb_tramite_tram_id_seq', 27, true);
          public          postgres    false    211                       0    0    tb_usuario_usua_id_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.tb_usuario_usua_id_seq', 4, true);
          public          postgres    false    209            h           2606    31690 $   tb_estado_civil tb_estado_civil_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.tb_estado_civil
    ADD CONSTRAINT tb_estado_civil_pkey PRIMARY KEY (esci_id);
 N   ALTER TABLE ONLY public.tb_estado_civil DROP CONSTRAINT tb_estado_civil_pkey;
       public            postgres    false    201            j           2606    31698 .   tb_grado_instruccion tb_grado_instruccion_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.tb_grado_instruccion
    ADD CONSTRAINT tb_grado_instruccion_pkey PRIMARY KEY (grin_id);
 X   ALTER TABLE ONLY public.tb_grado_instruccion DROP CONSTRAINT tb_grado_instruccion_pkey;
       public            postgres    false    203            p           2606    31719    tb_persona tb_persona_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tb_persona
    ADD CONSTRAINT tb_persona_pkey PRIMARY KEY (pers_id);
 D   ALTER TABLE ONLY public.tb_persona DROP CONSTRAINT tb_persona_pkey;
       public            postgres    false    208            l           2606    31706 $   tb_tipo_tramite tb_tipo_tramite_pkey 
   CONSTRAINT     g   ALTER TABLE ONLY public.tb_tipo_tramite
    ADD CONSTRAINT tb_tipo_tramite_pkey PRIMARY KEY (titr_id);
 N   ALTER TABLE ONLY public.tb_tipo_tramite DROP CONSTRAINT tb_tipo_tramite_pkey;
       public            postgres    false    205            t           2606    39982    tb_tramite tb_tramite_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tb_tramite
    ADD CONSTRAINT tb_tramite_pkey PRIMARY KEY (tram_id);
 D   ALTER TABLE ONLY public.tb_tramite DROP CONSTRAINT tb_tramite_pkey;
       public            postgres    false    212            n           2606    31711    tb_ubigeo tb_ubigeo_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.tb_ubigeo
    ADD CONSTRAINT tb_ubigeo_pkey PRIMARY KEY (ubig_id);
 B   ALTER TABLE ONLY public.tb_ubigeo DROP CONSTRAINT tb_ubigeo_pkey;
       public            postgres    false    206            r           2606    31755    tb_usuario tb_usuario_pkey 
   CONSTRAINT     ]   ALTER TABLE ONLY public.tb_usuario
    ADD CONSTRAINT tb_usuario_pkey PRIMARY KEY (usua_id);
 D   ALTER TABLE ONLY public.tb_usuario DROP CONSTRAINT tb_usuario_pkey;
       public            postgres    false    210            u           2606    31720 "   tb_persona tb_persona_esci_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_persona
    ADD CONSTRAINT tb_persona_esci_id_fkey FOREIGN KEY (esci_id) REFERENCES public.tb_estado_civil(esci_id);
 L   ALTER TABLE ONLY public.tb_persona DROP CONSTRAINT tb_persona_esci_id_fkey;
       public          postgres    false    2920    201    208            v           2606    31725 "   tb_persona tb_persona_grin_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_persona
    ADD CONSTRAINT tb_persona_grin_id_fkey FOREIGN KEY (grin_id) REFERENCES public.tb_grado_instruccion(grin_id);
 L   ALTER TABLE ONLY public.tb_persona DROP CONSTRAINT tb_persona_grin_id_fkey;
       public          postgres    false    203    208    2922            w           2606    31730 "   tb_persona tb_persona_ubig_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_persona
    ADD CONSTRAINT tb_persona_ubig_id_fkey FOREIGN KEY (ubig_id) REFERENCES public.tb_ubigeo(ubig_id);
 L   ALTER TABLE ONLY public.tb_persona DROP CONSTRAINT tb_persona_ubig_id_fkey;
       public          postgres    false    208    206    2926            y           2606    39988 "   tb_tramite tb_tramite_pers_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_tramite
    ADD CONSTRAINT tb_tramite_pers_id_fkey FOREIGN KEY (pers_id) REFERENCES public.tb_persona(pers_id);
 L   ALTER TABLE ONLY public.tb_tramite DROP CONSTRAINT tb_tramite_pers_id_fkey;
       public          postgres    false    208    212    2928            x           2606    39983 "   tb_tramite tb_tramite_titr_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_tramite
    ADD CONSTRAINT tb_tramite_titr_id_fkey FOREIGN KEY (titr_id) REFERENCES public.tb_tipo_tramite(titr_id);
 L   ALTER TABLE ONLY public.tb_tramite DROP CONSTRAINT tb_tramite_titr_id_fkey;
       public          postgres    false    2924    212    205            z           2606    39993 %   tb_tramite tb_tramite_usuario_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.tb_tramite
    ADD CONSTRAINT tb_tramite_usuario_id_fkey FOREIGN KEY (usuario_id) REFERENCES public.tb_usuario(usua_id);
 O   ALTER TABLE ONLY public.tb_tramite DROP CONSTRAINT tb_tramite_usuario_id_fkey;
       public          postgres    false    212    210    2930            �   @   x�3����	q���t�26�tvvt��t�9�<C��0ǈ��3�?��$������ ǬF          A   x�34���u�t�t�24�vu�s��M8�C\�<��@<S�P?�0נ`���P� �P           x�}��j�0�ϣ�0�� �,ɺ�I����(J/>������ʮ�E��	���]A���u5�5�C�+�]�dI
|���4����O].�C�H��2��ܬ(-����K{�l'ITJ61��I#m�=���x��4��E���Xt��q�%����۷��)B3������/Nk��ik6)X0O�9�T����b�6H����i�n>�����ɜB..ZB�Z��OA�ƴp�Ɗ�3�y喤�he���!����N���k�         ~   x�MMK!]�S��� Tӄ�����Vɋ	х���͋'�Z$���R'�b�<��)�g84�m�$�WEEJ>���k���6��4���-��`��o�Ԑ�&�l��묹�b��w�n����>NA*�      	      x������ � �         �  x�u�]n� ���Sp��3M���z:T�Y~*e�K�L��bf��J��G���g��>?�/p௎��]����鼮
A����&2�0qvW�&w,m��"�FM@JP~����o�/"��{רx`���u ۓDJ�������`�x�e���A���7�p��zN�z���&d��_9-ۭ��Bu�(˭��9ӲN�6��Ufh�yx�l2S�0%�������%����^��_��Z��>��������a�d�ht�1����'�R�jb/ӂU�e����E#:�2|�&�ͷ�>)Ը��7ӞƇ�#ײg�x�Osz�YA��#+�����MEZ��BP��ӳV28*�ՋB�q��'4�����梉m������, ��U,         U  x�mϻr�@�zy���r;Wv�e	�L5�D��\�>)t&g���8�7?PQ5����I!(	H+b�E~L<�Q�T:)/]q�7��N���܈_�t}�e�1�dq8,�릔%�3k��(r<�b L_Pl��^�ŌC�4�9�Q�\���dT��w]��{����Y�&2K��w-�~bы�"�BA{4�[���>���]��y�콺�6�.��Dt�4?��ԟ��ԝ~N���VN�2=A�Z(������c1~�`v]S�C��-�U�%Zܨ���Z���[�4���U����zo���Re�Wwz��俾_� ��A��     